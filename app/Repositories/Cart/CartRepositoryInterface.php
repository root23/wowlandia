<?php

namespace App\Repositories\Cart;

use Illuminate\Http\Request;

interface CartRepositoryInterface {
    public function getByToken(string $token);

    public function getTotal();

    public function getFinalTotal();

    public function getItemsCount(Request $request);
}
