<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderMailController extends Controller
{
    public static function sendEmail(Request $request)
    {
        $data = [
            'orderId' => $request->get('order_id'),
        ];

        Mail::to(env('ORDER_MAIL_ADDRESS'))->send(new OrderMail($data));
    }
}
