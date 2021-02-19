<?php

namespace App\Http\Controllers\Api\Nested;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * @var ReviewRepositoryInterface $reviewRepository
     */
    private $reviewRepository;

    public function __construct()
    {
        $this->reviewRepository = ReviewRepositoryInterface::class;
    }

    /**
     * Display the specified resource.
     *
     * @param int $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Product $product)
    {

        $reviews = $product->reviews()->get();

        if ($reviews->count() == 0) {
            return response()->json([
                'data' => 'Not found',
            ], 404);
        } else {
            return response()->json($reviews, 200);
        }
    }
}
