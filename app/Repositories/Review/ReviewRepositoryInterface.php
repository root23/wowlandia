<?php

namespace App\Repositories\Review;

interface ReviewRepositoryInterface {
    public function getAllByProductId(int $product_id);
}
