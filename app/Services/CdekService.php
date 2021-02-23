<?php

namespace App\Services;

use GuzzleHttp\Client;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;
use CdekSDK\CdekClient;
use CdekSDK\Requests;

class CdekService {

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

    public function calculateDeliveryPrice($token, $zipcode) {
        $cart = Cart::restore($token)->content();

        if (isset($cart)) {
            $maxWeight = $cart->map(function ($item, $key) {
                return $item->options['weight'];
            })->max();
            $maxWidth = $cart->map(function ($item, $key) {
                return $item->options['width'];
            })->max();
            $maxHeight = $cart->map(function ($item, $key) {
                return $item->options['height'];
            })->max();
            $maxDepth = $cart->map(function ($item, $key) {
                return $item->options['depth'];
            })->max();

            $deliveryOptions = [
                'weight' => $maxWeight,
                'width' => $maxWidth,
                'height' => $maxHeight,
                'depth' => $maxDepth,
            ];

            $tariffId = 11;
            $receiverCityPostCode = $zipcode;

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

                return null;
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
            return $data;

        } else {
            return null;
        }
    }
}
