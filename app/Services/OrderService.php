<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryInterface;

class OrderService {

    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository) {
        $this->cartRepository = $cartRepository;
    }
}
