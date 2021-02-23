<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function showOrderSuccessPopup(Request $request) {
        $paymentInfo = $request->all();
        $view = view('components.order-success')
            ->with('paymentInfo', $paymentInfo)
            ->render();
        return response()->json($view, 200);
    }
}
