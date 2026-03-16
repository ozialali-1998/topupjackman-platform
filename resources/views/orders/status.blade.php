@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-yellow-400 mb-6">Lacak Status Order</h1>
<form method="post" class="mb-6">@csrf
    <input name="order_id" placeholder="Order ID" class="px-4 py-3 rounded bg-zinc-900 border border-yellow-700 w-full md:w-96">
    <button class="gold-btn px-4 py-3 rounded mt-3">Cek Status</button>
</form>
@if(isset($order) && $order)
<div class="gold-card rounded-xl p-6 space-y-2">
    <div>Order ID: {{ $order->order_id }}</div>
    <div>User ID: {{ $order->guest_user_id }}</div>
    <div>Coins: {{ $order->product->coins }}</div>
    <div>Price: Rp{{ number_format($order->price,0,',','.') }}</div>
    <div>Payment Status: {{ $order->payment_status }}</div>
    <div>Order Status: {{ $order->status }}</div>
</div>
@endif
@endsection
