<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['cashier', 'items.product'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return redirect()->route('admin.pos.index');
    }

    public function show(Order $order)
    {
        $order->load(['cashier', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', Rule::in(['menunggu', 'selesai', 'dibatalkan'])],
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function printInvoice(Order $order)
    {
        $order->load(['cashier', 'items.product']);
        return view('admin.orders.print', compact('order'));
    }
}