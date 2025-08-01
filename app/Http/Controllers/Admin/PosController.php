<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        $search = $request->input('search');
        
        $products = Product::when($category_id, function ($query) use ($category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%");
            })
            ->get();

        $categories = Category::all();
        $cart = session()->get('cart', []);

        return view('admin.pos.index', compact('products', 'categories', 'category_id', 'search', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => $this->calculateTotal($cart)
        ]);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => $this->calculateTotal($cart)
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => $this->calculateTotal($cart)
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang belanja kosong.');
        }

        $total = $this->calculateTotal($cart);
        $amountPaid = $request->amount_paid;
        
        if ($amountPaid < $total) {
            return back()->with('error', 'Jumlah pembayaran kurang dari total.');
        }

        // Buat pesanan
        $order = new Order();
        $order->invoice_number = 'INV-' . Str::upper(Str::random(8));
        $order->cashier_id = auth()->id();
        $order->customer_name = $request->customer_name;
        $order->status = 'menunggu';
        $order->total = $total;
        $order->amount_paid = $amountPaid;
        $order->change = $amountPaid - $total;
        $order->save();

        // Simpan item pesanan
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat.');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}