<?php

namespace App\Repositories\Review;

use App\Models\Review;

class ReviewRepository implements ReviewRepositoryInterface {

    public function getAllByProductId(int $product_id)
    {
        $reviews = Review::where('product_id', $product_id)->get();

        return $reviews;
    }
}
