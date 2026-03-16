<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderStatusController extends Controller
{
    public function index(): View
    {
        return view('orders.status');
    }

    public function show(Request $request): View
    {
        $request->validate(['order_id' => ['required', 'string']]);
        $order = Order::query()->where('order_id', $request->order_id)->with('product')->first();

        return view('orders.status', compact('order'));
    }
}
