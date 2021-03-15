<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    public function created(Order $order)
    {
        $user = User::where('name', 'notify')->first();
        $user->notify(new OrderCreatedNotification($order));
//        Notification::send(env('ORDER_MAIL_ADDRESS'), new OrderCreatedNotification($order));
//        Notification::route('mail', env('ORDER_MAIL_ADDRESS'))->notify(New OrderCreatedNotification($order));
    }
}
