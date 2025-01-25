<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditSerial extends Model
{
    protected $table = 'credit_serials';

    protected $fillable = [
        'transaction_ID',
        'carbon_credit_ID',
        'quantity',
        'serial_code',
    ];

    // Relationship với Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_ID');
    }

    // Relationship với Carbon Project
    public function credits()
    {
        return $this->belongsTo(Credit::class, 'carbon_credits_ID');
    }
}
