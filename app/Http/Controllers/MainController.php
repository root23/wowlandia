<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class MainController extends Controller
{

    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function index() {
        $products = $this->productRepository->getAll();
        $productTypes = ProductType::where('is_active', 1)->get();

        return view('welcome')
            ->with(compact('products', 'productTypes'));
    }

    public function getSizes(Request $request) {
        $productId = $request->get('product_id');
        $view = view('components.product-sizes')
            ->with('product_id', $productId)
            ->render();
        return response()->json($view, 200);
    }

    public function reviewSuccess() {
        $view = view('components.review-success')->render();
        return response()->json($view, 200);
    }

    public function getPrivacyPage()
    {
        $productTypes = ProductType::where('is_active', 1)->get();
        return view('privacy')->with([
            'productTypes' => $productTypes,
        ]);
    }
}
