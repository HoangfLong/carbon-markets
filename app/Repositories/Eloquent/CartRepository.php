<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

/**
 * Class CartRepository.
 */
class CartRepository
{
    public function getCart()
    {
        return Cart::firstOrCreate(['user_ID' => Auth::id()]);
    }
}