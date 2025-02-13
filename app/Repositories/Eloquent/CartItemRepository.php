<?php

namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Models\Credit;
//use Your Model

/**
 * Class CartItemRepository.
 */
class CartItemRepository
{
    protected $cartRepo;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function addToCart($creditId, $quantity)
    {
        $cart = $this->cartRepo->getCart();
        $credit = Credit::findOrFail($creditId);

        return CartItem::create([
            'cart_id'   => $cart->id,
            'credit_ID' => $credit->id,
            'quantity'  => $quantity,
            'price'     => $credit->price_per_ton,
        ]);
    }


    public function getCartItems()
    {
        $cart = $this->cartRepo->getCart();

        if (!$cart) {
            return collect(); // Trả về collection rỗng nếu không có giỏ hàng
        }

        return CartItem::where('cart_id', $cart->id)
                ->whereHas('credit', function ($query) {
                    $query->whereNotNull('project_ID');
                }) // Ensure credits have valid projects
                ->with(['credit.project'])
                ->get();
    }
}
