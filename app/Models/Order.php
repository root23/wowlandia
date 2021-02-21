<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'invoice_id',
        'amount',
        'is_paid',
        'description',
        'shopping_cart_id',
    ];
}
