<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @var ProductRepositoryInterface $repository
     */
    private $repository;

    public function __construct(ProductRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = $this->repository->getAll();
        if (!$products) {
            return response()->json(null, 204);
        } else {
            return response()->json($products, 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $product = $this->repository->getById($id);
        if (!$product) {
            return response()->json([
                'data' => 'Not found',
            ], 404);
        } else {
            return $product;
        }
    }

}
