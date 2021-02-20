<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartUpdateRequest;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\CartService;
use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;


class CartController extends Controller
{
    /**
     * @var CartService $service
     */
    private $service;

    /**
     * @var CartRepositoryInterface $repository
     */
    private $repository;

    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private $productRepository;

    public function __construct(CartService $service, CartRepositoryInterface $repository, ProductRepositoryInterface $productRepository) {
        $this->service = $service;
        $this->repository = $repository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = $this->repository->getByToken(csrf_token());

        if (isset($cart)) {
            return response()->json($cart->content(), 200);
        } else {
            return response()->json([
                'data' => 'Not found',
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        if ($request->get('action') == 'add') {
            return $this->service->addItem($request);
        } elseif ($request->get('action') == 'remove') {
            return $this->service->removeItem($request);
        } elseif ($request->get('action') == 'delete') {
            return $this->service->deleteItem($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->service->clear($request);
    }
}
