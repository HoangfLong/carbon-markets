<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_ID',
        'carbon_credit_ID',
        'quantity',
        'price_per_ton',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_ID');
    }

    public function credit()
    {
        return $this->belongsTo(Credit::class, 'carbon_credit_ID');
    }
}
