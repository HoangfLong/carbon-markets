<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_ID',
        'total_amount',
        'status',
        'country',
        'company',
        'address'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_ID');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'order_ID');
    }
}
