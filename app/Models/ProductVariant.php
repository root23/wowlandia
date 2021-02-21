<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ProductVariant extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'title',
        'product_id',
        'price',
        'sale_price',
        'cover_image',
        'color',
        'type',
        'size',
        'delivery_width',
        'delivery_height',
        'delivery_depth',
        'delivery_weight',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
