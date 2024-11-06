<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'product_id',
        'amount',
        'quantity'
    ];

    public static function generateOrderNumber(): string
    {
        return Str::random(15);
    }
}
