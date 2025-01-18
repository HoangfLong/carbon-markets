<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'order_ID',
        'amount',
        'status',
        'payment_method',
        'transaction_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_ID');
    }
}
