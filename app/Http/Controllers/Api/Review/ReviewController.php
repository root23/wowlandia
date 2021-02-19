<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Controller;
use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReviewController extends Controller
{

    private $repository;

    public function __construct(ReviewRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * Display the specified resource.
     *
     * @param int $product_id
     * @return Response
     */
    public function showReviewsForProduct(int $product_id): Response
    {
        $reviews = $this->repository->getAllByProductId($product_id);

        if (!$reviews) {
            return response()->json([
                'data' => 'Not found',
            ], 404);
        } else {
            return $reviews;
        }
    }

}
