<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TopUpController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()->where('is_active', true)->orderBy('coins')->get();

        return view('topup.index', [
            'products' => $products,
            'userId' => $request->string('user_id')->toString(),
        ]);
    }

    public function checkout(Request $request): View
    {
        $validated = $request->validate([
            'user_id' => ['required', 'string', 'max:100'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $adminFee = 1500;

        return view('checkout.index', [
            'userId' => $validated['user_id'],
            'product' => $product,
            'adminFee' => $adminFee,
            'total' => $product->price + $adminFee,
        ]);
    }

    public function createOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'guest_user_id' => ['required', 'string', 'max:100'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $adminFee = 1500;
        $order = Order::create([
            'order_id' => 'KAKO-'.strtoupper(Str::random(10)),
            'user_id' => auth()->id(),
            'guest_user_id' => $validated['guest_user_id'],
            'product_id' => $product->id,
            'price' => $product->price,
            'admin_fee' => $adminFee,
            'total_payment' => $product->price + $adminFee,
            'status' => 'PENDING',
            'payment_status' => 'pending',
            'payment_method' => 'midtrans_snap',
        ]);

        return redirect()->route('checkout.show', $order);
    }

    public function showCheckout(Order $order): View
    {
        return view('checkout.pay', compact('order'));
    }
}
