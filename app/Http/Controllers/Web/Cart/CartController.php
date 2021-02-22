<?php

namespace App\Http\Controllers\Web\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartController {

    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCartAjax(Request $request) {
        $csrfToken = $request->header('X-CSRF-TOKEN');
        $cart = $this->cartRepository->getByToken($csrfToken)->content();
        $view = view('components.cart')->with('cart', $cart)->render();
        if ($cart) {
            $view = view('components.cart')->with('cart', $cart)->render();
            return response()->json($view, 200);
        } else {
            return response()->json('No data', 404);
        }
    }
}
