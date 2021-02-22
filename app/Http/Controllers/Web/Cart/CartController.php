<?php

namespace App\Http\Controllers\Web\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\ProductVariant\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;

class CartController {

    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    /**
     * @var ProductVariantRepositoryInterface $productVariantRepository
     */
    private $productVariantRepository;

    public function __construct(CartRepositoryInterface $cartRepository, ProductVariantRepositoryInterface $productVariantRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function getCartAjax(Request $request) {
        $csrfToken = $request->header('X-CSRF-TOKEN');
        $cart = $this->cartRepository->getByToken($csrfToken)->content();
        $images = $this->productVariantRepository->getImages();
        $view = view('components.cart')
            ->with([
                'cart' => $cart,
                'images' => $images,
            ])
            ->render();
        if ($cart) {
            return response()->json($view, 200);
        } else {
            return response()->json('No data', 404);
        }
    }
}
