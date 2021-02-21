<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface {

    /**
     * @return Product[]|Collection
     */
    public function getAll()
    {
        return Product::all();
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getById(int $id)
    {
        $product = Product::where('id', $id)
            ->with('productVariants')
            ->first();
        if ($product) {
            return $product;
        } else {
            return null;
        }
    }
}
