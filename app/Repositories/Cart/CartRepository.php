<?php

namespace App\Repositories\Cart;

use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class CartRepository implements CartRepositoryInterface {

    public function getByToken(string $token)
    {
        $cart = Cart::restore($token);

        return $cart;
    }
}
