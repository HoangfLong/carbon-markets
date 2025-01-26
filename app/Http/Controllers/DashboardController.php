<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() : View
    {
        // Tổng doanh thu
        $totalRevenue = Order::sum('total_amount');

        // Doanh thu theo tháng
        $monthlyRevenue = DB::table('orders')
        ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
        ->groupByRaw('MONTH(created_at)')
        ->get();

        // Đơn hàng mới nhất
        $latestOrders = Order::with('orderItems.credit.projects')->latest()->take(5)->get();

        return view('admin.dashboard', compact([
            'totalRevenue',
            'monthlyRevenue',
            'latestOrders',
        ]));
    }
}
