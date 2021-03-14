<?php

namespace App\Services;

use App\Http\Controllers\Mail\OrderMailController;
use App\Models\Order;
use App\Repositories\Cart\CartRepositoryInterface;
use GuzzleHttp\Client;
use Idma\Robokassa\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrderService {

    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    /**
     * @var PochtaService $pochtaService;
     */
    private $pochtaService;

    /**
     * @var CdekService $cdekService
     */
    private $cdekService;


    public function __construct(CartRepositoryInterface $cartRepository, PochtaService $pochtaService, CdekService $cdekService) {
        $this->cartRepository = $cartRepository;
        $this->pochtaService = $pochtaService;
        $this->cdekService = $cdekService;
    }

    public function createOrder(Request $request) {
        $request->validate([
            'username' => 'required|max:255',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $csrf = $request->header('X-CSRF-TOKEN');

        $cartPrice = $this->cartRepository->getFinalTotalByToken($csrf);
        $zipcode = $request->get('zipcode');
        $deliveryType = $request->get('delivery');
        $paymentType = $request->get('payment_method');

        if ($paymentType == 'bank') {
            $finalPrice = $cartPrice;
            $paymentData = [
                'payment_type' => 'bank',
                'payment_info' => 'Наши менеджеры свяжутся с Вами в ближайшее время!',
                'payment_id' => hexdec(uniqid()),
            ];
        } else {
            $deliveryPrice = $this->calculateDeliveryPrice($cartPrice, $deliveryType, $zipcode, $csrf);
            $finalPrice = $deliveryPrice + $cartPrice;
            $paymentData = $this->getPayment($finalPrice);
        }

        $order = new Order();
        $order->amount = 3;
        $order->invoice_id = $paymentData['payment_id'];
        $order->is_paid = 0;
        $order->description = 'Заказ оформлен';
        $order->shopping_cart_id = $csrf;
        $order->username = $request->get('username');
        $order->phone = $request->get('phone');
        $order->email = $request->get('email');
        $order->zip_code = $request->get('zipcode');
        $order->city_name = $request->get('city_name');
        $order->address = $request->get('address');
        $order->total = $finalPrice;
        $order->delivery_type = $request->get('delivery');
        $order->save();

        // Send email
        $response = Http::get('https://wowlandia.ru/send-mail-order', [
            'order_id' => $order->id,
        ]);

        return $paymentData;
    }

    private function calculateDeliveryPrice($cartPrice, $deliveryType, $zipcode, $token, $freeDeliveryPrice = 5900) {
        if ($cartPrice >= $freeDeliveryPrice || $deliveryType == 'self' || $deliveryType == 'bank') {
            return 0;
        }
        if ($deliveryType == 'russianpost') {
            $data = $this->pochtaService->getDeliveryRateByZipcode($zipcode);
            return $data['price'];
        }
        if ($deliveryType == 'cdek') {
            $data = $this->cdekService->calculateDeliveryPrice($token, $zipcode);
            return $data[0]['price'];
        }
    }

    private function getPayment($price) {
        $payment = new Payment(
            env('ROBOKASSA_LOGIN'),
            env('ROBOKASSA_PASSWORD'),
            env('ROBOKASSA_PASSWORD2'),
            env('ROBOKASSA_TEST_MODE')
        );

        $id = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $next_id = $id[0]->Auto_increment;

        $payment
            ->setInvoiceId($next_id)
            ->setSum($price)
            ->setDescription('some description');

        return [
            'payment_type' => 'robokassa',
            'payment_url' => $payment->getPaymentUrl(),
            'payment_id' => $payment->getInvoiceId(),
        ];
    }
}
