<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['cashier', 'items.product'])
            ->where('cashier_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('cashier.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan order milik kasir yang login
        if ($order->cashier_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['cashier', 'items.product']);
        return view('cashier.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Pastikan order milik kasir yang login
        if ($order->cashier_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => ['required', Rule::in(['menunggu', 'selesai', 'dibatalkan'])],
        ]);

        // Kasir hanya bisa mengubah status jika belum selesai
        if ($order->status === 'selesai') {
            return back()->with('error', 'Tidak dapat mengubah status pesanan yang sudah selesai.');
        }

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function printInvoice(Order $order)
    {
        // Pastikan order milik kasir yang login
        if ($order->cashier_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['cashier', 'items.product']);
        return view('cashier.orders.print', compact('order'));
    }
}