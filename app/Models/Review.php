<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Review extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'email',
        'title',
        'rating',
        'message',
        'is_active',
        'product_id',
        'image',
    ];
}
