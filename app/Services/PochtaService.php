<?php

namespace App\Services;

use Illuminate\Http\Request;
use LapayGroup\RussianPost\Providers\OtpravkaApi;
use LapayGroup\RussianPost\ParcelInfo;

class PochtaService {

    public function getDeliveryRateByZipcode($zipcode) {
        $config = [
            'auth' => [
                'otpravka' => [
                    'token' => env('POCHTA_TOKEN'),
                    'key' => env('POCHTA_KEY'),
                ],
            ],
        ];
        $api = new OtpravkaApi($config);
        $operatorPostcode = $api->shippingPoints()[0]['operator-postcode'];

        $parcelInfo = new ParcelInfo();
        $parcelInfo->setIndexFrom($operatorPostcode); // Индекс пункта сдачи из функции $OtpravkaApi->shippingPoints()
        $parcelInfo->setIndexTo($zipcode);
        $parcelInfo->setMailCategory('ORDINARY'); // https://otpravka.pochta.ru/specification#/enums-base-mail-category
        $parcelInfo->setMailType('POSTAL_PARCEL'); // https://otpravka.pochta.ru/specification#/enums-base-mail-type
        $parcelInfo->setWeight(1000);
        $parcelInfo->setFragile(true);

        $tariffInfo = $api->getDeliveryTariff($parcelInfo);
        $price = floor($tariffInfo->getTotalRate()/100);
        $maxDays = $tariffInfo->getDeliveryMaxDays();
        return [
            'price' => $price,
            'maxDays' => $maxDays,
        ];
    }

    public function getDeliveryRate(Request $request) {
        $config = [
            'auth' => [
                'otpravka' => [
                    'token' => env('POCHTA_TOKEN'),
                    'key' => env('POCHTA_KEY'),
                ],
            ],
        ];
        $api = new OtpravkaApi($config);
        $operatorPostcode = $api->shippingPoints()[0]['operator-postcode'];

        $parcelInfo = new ParcelInfo();
        $parcelInfo->setIndexFrom($operatorPostcode); // Индекс пункта сдачи из функции $OtpravkaApi->shippingPoints()
        $parcelInfo->setIndexTo($request->get('receiver_zip'));
        $parcelInfo->setMailCategory('ORDINARY'); // https://otpravka.pochta.ru/specification#/enums-base-mail-category
        $parcelInfo->setMailType('POSTAL_PARCEL'); // https://otpravka.pochta.ru/specification#/enums-base-mail-type
        $parcelInfo->setWeight(1000);
        $parcelInfo->setFragile(true);

        $tariffInfo = $api->getDeliveryTariff($parcelInfo);
        $price = floor($tariffInfo->getTotalRate()/100);
        $maxDays = $tariffInfo->getDeliveryMaxDays();
        return [
          'price' => $price,
          'maxDays' => $maxDays,
        ];
    }
}
