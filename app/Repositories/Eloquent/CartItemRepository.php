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

    // Add to cart
    public function addToCart($creditId, $quantity)
    {
        $cart = $this->cartRepo->getCart();

        $credit = Credit::findOrFail($creditId);

        $quantity = $credit->minimum_purchase;

        // Check if it had project in cart
        $existingCartItem = CartItem::where('cart_id', $cart->id)
                                    ->where('credit_ID', $credit->id)
                                    ->first();
        // If have project
        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity; 
            $existingCartItem->save();
            return [
                'success' => true,
                'message' => 'Updated cart item quantity successfully',
                'cartItem' => $existingCartItem
            ];
        }                        

        return CartItem::create([
            'cart_id'   => $cart->id,
            'credit_ID' => $credit->id,
            'quantity'  => $quantity,
            'price'     => $credit->price_per_ton,
        ]);
    }

    //Update
    public function updateCartItem($cartItemId, $newQuantity)
    {
        // Find the CartItem by ID
        $cartItem = CartItem::find($cartItemId);

        if (!$cartItem) {
            return ['success' => false, 'message' => 'Cart item not found'];
        }

        // Update the cart item's quantity
        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        // Return updated price after update
        return [
            'success' => true,
            'message' => 'Cart item updated successfully',
            'price' => $cartItem->price, // Return the updated price
        ];
    }

    // Delete
    public function clearCartItems($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
    
        if ($cartItem) {
            $cartItem->delete();
            return ['success' => true, 'message' => 'Cart item removed successfully'];
        }
    
        return ['success' => false, 'message' => 'Cart item not found'];
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
