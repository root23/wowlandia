<?php

namespace App\Repositories\ProductVariant;

use App\Models\ProductVariant;

class ProductVariantRepository implements ProductVariantRepositoryInterface {
    public function getByid(int $id)
    {
        $productVariant = ProductVariant::where('id', $id)
            ->with('product')
            ->first();

        if ($productVariant) {
            return $productVariant;
        } else {
            return null;
        }
    }
}
