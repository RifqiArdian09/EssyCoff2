<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::whereDate('created_at', today())->count();
        
        // Monthly revenue data
        $monthlyRevenue = Order::where('status', 'completed')
            ->selectRaw('YEAR(created_at) year, MONTH(created_at) month, SUM(total) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
            
        // Popular products
        $popularProducts = Product::withCount('orderItems')
            ->with('category')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        // Recent orders (add this)
        $recentOrders = Order::with('cashier')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEmployees',
            'totalProducts',
            'totalOrders',
            'monthlyRevenue',
            'popularProducts',
            'recentOrders' // Add this to the compact function
        ));
    }
}