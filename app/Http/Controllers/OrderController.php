<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_ID', Auth::id())
                        ->with(['orderItems.credit','transaction'])
                        ->latest()
                        ->paginate(10);
        
        return view('orders.index',compact('orders'));
    }

    public function show(Order $order): View
    {
        if ($order->user_ID !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        // Load thêm quan hệ orderItems.creditSerials
        $order->load(['orderItems.creditSerials']);

        return view('orders.show', compact('order'));
    }
}
