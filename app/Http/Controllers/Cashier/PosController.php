<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PosController extends Controller
{
    /**
     * Display the POS interface
     */
    public function index(Request $request)
    {
        $category_id = $request->input('category_id');
        $search = $request->input('search');
        
        $products = Product::with('category')
            ->when($category_id, function ($query) use ($category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%$search%");
            })
            ->orderBy('name')
            ->get();

        $categories = Category::orderBy('name')->get();
        $cart = session()->get('cart', []);

        return view('cashier.pos.index', [
            'products' => $products,
            'categories' => $categories,
            'category_id' => $category_id,
            'search' => $search,
            'cart' => $cart,
            'total' => $this->calculateTotal($cart)
        ]);
    }

    /**
     * Add product to cart
     */
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
            'total' => $this->calculateTotal($cart),
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Update product quantity in cart
     */
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
            'total' => $this->calculateTotal($cart),
            'item_total' => $cart[$request->product_id]['price'] * $request->quantity
        ]);
    }

    /**
     * Remove product from cart
     */
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
            'total' => $this->calculateTotal($cart),
            'cart_count' => count($cart)
        ]);
    }

    /**
     * Clear all items from cart
     */
    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    /**
     * Process checkout and create order
     */
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

        // Generate unique invoice number
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . Str::upper(Str::random(4));

        // Create order
        $order = Order::create([
            'invoice_number' => $invoiceNumber,
            'cashier_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'status' => 'selesai', // Kasir langsung menyelesaikan order
            'total' => $total,
            'amount_paid' => $amountPaid,
            'change' => $amountPaid - $total,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to order details with print option
        return redirect()->route('cashier.orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat.')
            ->with('print', true);
    }

    /**
     * Calculate total amount from cart
     */
    private function calculateTotal(array $cart): float
    {
        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    /**
     * Get cart data via AJAX
     */
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => $this->calculateTotal($cart),
            'cart_count' => count($cart)
        ]);
    }
}