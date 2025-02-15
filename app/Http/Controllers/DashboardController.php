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
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, MONTHNAME(created_at) as month_name, SUM(total_amount) as total')
        ->groupByRaw('YEAR(created_at), MONTH(created_at), MONTHNAME(created_at)')
        ->orderByRaw('YEAR(created_at), MONTH(created_at)')
        ->get();
    

        // Đơn hàng mới nhất
        $latestOrders = Order::with('orderItems.credit.project')->latest()->take(5)->get();

        return view('admin.dashboard', compact([
            'totalRevenue',
            'monthlyRevenue',
            'latestOrders',
        ]));
    }
}
