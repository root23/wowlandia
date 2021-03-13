<?php

namespace App\Http\Controllers\Web\Compilation;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CompilationController extends Controller
{
    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function show(Request $request)
    {
        $tagId = $request->get('tag_id');
        $productType = ProductType::where('id', $tagId)->first();
        $productTypes = ProductType::where('is_active', 1)->get();
        $products = $this->productRepository->getByTagId($tagId);
        if ($products->count() > 0) {
            $products = $this->productRepository->getByTagId($tagId);
            return view('compilation')
                ->with([
                    'products' => $products,
                    'productType' => $productType,
                    'productTypes' => $productTypes,
                ]);
        } else {
            abort(404);
        }
    }
}
