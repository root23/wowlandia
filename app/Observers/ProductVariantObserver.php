<?php

namespace App\Observers;

use App\Models\ProductVariant;
use Intervention\Image\Facades\Image;

class ProductVariantObserver
{
    public function created(ProductVariant $productVariant)
    {
        $this->makeJpgImage($productVariant);
    }

    public function updated(ProductVariant $productVariant)
    {
        $this->makeJpgImage($productVariant);
    }

    private function makeJpgImage(ProductVariant $productVariant)
    {
        if (pathinfo($productVariant->cover_image)['extension'] != 'jpg') {
            $imageName = pathinfo($productVariant->cover_image)['basename'] . '.jpg';
            $savePath = storage_path() . '/app/public/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $imageName;
            $newCoverImage = '/storage/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $imageName;
            $image = Image::make(env('APP_URL') . '/' . $productVariant->cover_image)->encode('jpg', 75)->save($savePath);
            $productVariant->cover_image = $newCoverImage;
            $productVariant->save();
        }
    }
}
