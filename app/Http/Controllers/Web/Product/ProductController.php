<?php

namespace App\Http\Controllers\Web\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController {

    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $id
     */
    public function getProductCartAjax(Request $request) {
        if ($request->get('id')) {
            $product = $this->productRepository->getById($request->get('id'));
            if ($product->exists) {
                $view = view('components.product-cart')->with('product', $product)->render();
                return response()->json($view, 200);
            } else {
                return response()->json('No data', 404);
            }
        } else {
            return response()->json('Set product id', 404);
        }
    }
}
