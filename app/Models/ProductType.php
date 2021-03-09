<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class ProductType extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
      'title',
      'is_active',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
