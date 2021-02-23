<?php

namespace App\Http\Controllers;

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

        return view('welcome')
            ->with(compact('products'));
    }

    public function getSizes() {
        $view = view('components.product-sizes')->render();
        return response()->json($view, 200);
    }
}
