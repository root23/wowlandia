<?php

namespace App\Observers;

use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProductObserver
{
    public function created(Product $product)
    {
        $this->makeJpgImage($product);
    }

    public function updated(Product $product)
    {
        $this->makeJpgImage($product);
    }

    private function makeJpgImage(Product $product)
    {
        if (pathinfo($product->cover_image)['extension'] != 'jpg') {
            $imageName = pathinfo($product->cover_image)['basename'] . '.jpg';
            $savePath = storage_path() . '/app/public/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $imageName;
            $newCoverImage = '/storage/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $imageName;
            $image = Image::make(env('APP_URL') . '/' . $product->cover_image)->encode('jpg', 75)->save($savePath);
            $product->cover_image = $newCoverImage;
            $product->save();
        }
    }
}
