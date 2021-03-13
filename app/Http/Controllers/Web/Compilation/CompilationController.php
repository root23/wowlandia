<?php

namespace App\Http\Controllers\Web\Compilation;

use App\Http\Controllers\Controller;
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
        if ($request->get('tag_id')) {
            $products = $this->productRepository->getByTagId($tagId);
            return view('compilation')
                ->with([
                    'products' => $products
                ]);
        } else {
            abort(404);
        }
    }
}
