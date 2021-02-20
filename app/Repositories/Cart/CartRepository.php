<?php

namespace App\Repositories\Cart;

use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class CartRepository implements CartRepositoryInterface {

    public function getByToken(string $token)
    {
        $cart = Cart::restore($token);

        return $cart;
    }

    public function getTotal()
    {
        $cart = Cart::restore(csrf_token());

        if ($cart) {
            return $cart->getTotal();
        } else {
            return null;
        }
    }

    public function getFinalTotal()
    {
        $cart = Cart::restore(csrf_token())->content();
        if (isset($cart)) {
            $sum = 0;
            foreach ($cart as $cartItem) {
                if ($cartItem->options['sale_price']) {
                    $sum += $cartItem->options['sale_price'] * $cartItem->quantity;
                } else {
                    $sum += $cartItem->price * $cartItem->quantity;
                }
            }
            return $sum;
        } else {
            return null;
        }
    }
}
