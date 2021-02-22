<?php

namespace App\Http\Controllers\Api\Cdek;

use App\Services\CartService;
use CdekSDK\CdekClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use CdekSDK\Requests;

class CdekController {

    /**
     * @var CdekClient $client
     */
    private $client;

    public function __construct(CdekClient $client)
    {
        $this->client =  new CdekClient('EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI', 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG', new Client([
            'base_uri' => 'https://integration.edu.cdek.ru',
        ]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCityAutoFill(Request $request) {
        if ($request->get('city_name')) {
            $url = 'https://api.cdek.ru/city/getListByTerm/jsonp.php';
            $client = new Client();
            $q = $request->get('city_name');

            $response = $client->request('GET', $url, ['query' => [
                'q' => $q,
            ]]);

            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody(), true);

            return response()->json([
                $content
            ], $statusCode);
        } else {
            return response()->json([
                'data' => 'Not found',
            ], 404);
        }
    }

    public function getDeliveryPrice(Request $request) {

        $deliveryOptions = CartService::getOptionsForDelivery();

        $tariffId = $request->get('tariff_id');
        if (!isset($tariffId)) {
            $tariffId = 11;
        }

        $receiverCityPostCode = $request->get('receiver_zip');

        $req = new Requests\CalculationWithTariffListRequest();
        $req->setSenderCityPostCode('143962')
            ->setReceiverCityPostCode($receiverCityPostCode)
            ->addTariffToList($tariffId)
            ->addPackage([
                'weight' => $deliveryOptions['weight'],
                'length' => $deliveryOptions['depth'],
                'width' => $deliveryOptions['width'],
                'height' => $deliveryOptions['height'],
            ]);

        $response = $this->client->sendCalculationWithTariffListRequest($req);

        /** @var \CdekSDK\Responses\CalculationWithTariffListResponse $response */
        if ($response->hasErrors()) {

            $errorsArray = [];
            foreach ($errors = $response->getErrors() as $error) {
                array_push($errorsArray, [
                   'code' => $error->getCode(),
                   'message' => $error->getMessage()
                ]);
            }

            return response()->json([
                'errors' => $errorsArray
            ], 404);
        }

        $data = [];

        foreach ($response->getResults() as $result) {
            if ($result->hasErrors()) {
                // обработка ошибок

                continue;
            }

            if (!$result->getStatus()) {
                continue;
            }

            array_push($data, [
                'tarif_id' => $result->getTariffId(),
                'price' => $result->getPrice(),
                'period_min' => $result->getDeliveryPeriodMin(),
                'period_max' => $result->getDeliveryPeriodMax(),
            ]);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }
}
