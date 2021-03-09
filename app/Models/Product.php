<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;
use App\Models\Review;

class Product extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'is_active',
        'tag',
        'delivery_width',
        'delivery_height',
        'delivery_depth',
        'delivery_weight',
    ];

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function productVariants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function types()
    {
        return $this->belongsToMany(ProductType::class);
    }
}
