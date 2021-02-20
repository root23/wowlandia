<?php

namespace App\Repositories\ProductVariant;

use App\Models\ProductVariant;

class ProductVariantRepository implements ProductVariantRepositoryInterface {
    public function getByid(int $id)
    {
        $productVariant = ProductVariant::find($id);

        if ($productVariant) {
            return $productVariant->first();
        } else {
            return null;
        }
    }
}
