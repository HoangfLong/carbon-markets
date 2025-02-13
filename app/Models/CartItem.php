<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'credit_ID',
        'quantity',
        'price',
    ];

    public function credit()
    {
        return $this->belongsTo(Credit::class, 'credit_ID');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    // Tính tổng giá trị của item
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}
