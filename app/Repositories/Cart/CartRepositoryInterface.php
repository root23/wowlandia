<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface {
    public function getByToken(string $token);
}
