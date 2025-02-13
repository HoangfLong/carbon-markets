<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_ID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_ID');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Tính tổng giá trị giỏ hàng
    public function getTotalAttribute()
    {
        return $this->items->sum(fn ($item) => $item->price * $item->quantity);
    }
}
