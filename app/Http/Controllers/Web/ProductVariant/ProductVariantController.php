<?php

namespace App\Http\Controllers\Web\ProductVariant;

use App\Models\ProductVariant;
use Intervention\Image\Facades\Image;

class ProductVariantController
{
    public function encodeImagesToJpg()
    {
        $products = ProductVariant::all();
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
