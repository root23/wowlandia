<?php

namespace App\Http\Controllers\Web\Product;

use App\Models\Product;
use App\Models\Review;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

            $reviews = Review::orderBy('created_at', 'DESC')
                ->where('product_id', $request->get('id'))
                ->where('is_active', true)
                ->get();

            if ($product->exists) {
                $view = view('components.product-cart')
                    ->with('product', $product)
                    ->with('reviews', $reviews)
                    ->render();
                return response()->json($view, 200);
            } else {
                return response()->json('No data', 404);
            }
        } else {
            return response()->json('Set product id', 404);
        }
    }

    public function encodeImagesToJpg()
    {
        $products = Product::all();
        foreach ($products as $product) {
            if (!isset(pathinfo($product->cover_image)['extension'])) {
                continue;
            }
            if (pathinfo($product->cover_image)['extension'] != 'jpg') {
                $imageName = pathinfo($product->cover_image)['basename'] . '.jpg';
                $savePath = storage_path() . '/app/public/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $imageName;
                $newCoverImage = '/storage/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $imageName;
                $image = Image::make(env('APP_URL') . '/' . $product->cover_image)->encode('jpg', 75)->save($savePath);
                $product->cover_image = $newCoverImage;
                $product->save();
            }
        }
        dd('Конвертация завершена.');
    }
}
