<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class CartService {

    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private $productRepository;

    public function __construct(CartRepositoryInterface $cartRepository, ProductRepositoryInterface  $productRepository) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function store(Request $request) {
        Cart::store($request->get('token'));
    }

    public function addItem(Request $request) {
        if ($request->get('action') == 'add') {
            $productId = $request->get('product_id');
            $product = $this->productRepository->getById($productId);

            if ($product == null) {
                return response()->json([
                    'data' => 'product not found',
                ], 404);
            }

            $cart = Cart::restore(csrf_token());
            Cart::add($product->id, $product->title, 50, 1);

            Cart::store(csrf_token());

            return response()->json([
               'cart' => Cart::content(),
            ], 200);

        } else {
            return response()->json([
                'data' => 'wrong action type',
            ], 404);
        }
    }
}
