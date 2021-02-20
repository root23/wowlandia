<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductVariant\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class CartService {

    /**
     * @var CartRepositoryInterface $cartRepository
     */
    private $cartRepository;

    /**
     * @var ProductRepositoryInterface $productVariantRepository
     */
    private $productVariantRepository;

    public function __construct(CartRepositoryInterface $cartRepository,
                                ProductVariantRepositoryInterface $productVariantRepository) {
        $this->cartRepository = $cartRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function store(Request $request) {
        Cart::store($request->get('token'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItem(Request $request) {
        if ($request->get('action') == 'add') {
            $productId = $request->get('product_id');
            $product = $this->productVariantRepository->getById($productId);

            if ($product == null) {
                return response()->json([
                    'data' => 'product not found',
                ], 404);
            }

            $cart = Cart::restore(csrf_token());
            Cart::add($product->id, $product->title, $product->price, 1, [
                'sale_price' => $product->sale_price,
                'color' => $product->color,
                'size' => $request->get('size'),
                'type' => $product->type,
            ]);

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

    public function removeItem(Request $request) {
        if ($request->get('action') == 'remove') {
            $itemId = $request->get('product_uid');

            $cart = Cart::restore(csrf_token())->content();

            if ($cart->has($itemId)) {
                $cartItem = Cart::get($itemId);
                if ($cartItem->quantity == 1) {
                    Cart::remove($cartItem->getUniqueId());
                } else {
                    Cart::add($cartItem->id, $cartItem->name, $cartItem->price, -1, [
                        'sale_price' => $cartItem->options['sale_price'],
                        'color' => $cartItem->options['color'],
                        'size' => $cartItem->options['size'],
                        'type' => $cartItem->options['type'],
                    ]);
                }
                Cart::store(csrf_token());

                return response()->json([
                    'cart' => Cart::content(),
                ], 200);
            } else {
                return response()->json([
                    'data' => 'wrong item uuid',
                ], 404);
            }

        } else {
            return response()->json([
                'data' => 'wrong action type',
            ], 404);
        }
    }
}
