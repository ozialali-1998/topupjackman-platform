@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-yellow-400 mb-6">Checkout</h1>
<div class="gold-card p-6 rounded-xl space-y-2">
    <div>User ID: {{ $userId }}</div>
    <div>Paket: {{ $product->coins }} Coins</div>
    <div>Harga: Rp{{ number_format($product->price,0,',','.') }}</div>
    <div>Admin Fee: Rp{{ number_format($adminFee,0,',','.') }}</div>
    <div class="font-bold text-yellow-400">Total Payment: Rp{{ number_format($total,0,',','.') }}</div>
</div>
<form method="post" action="{{ route('topup.create-order') }}" class="mt-4">@csrf
    <input type="hidden" name="guest_user_id" value="{{ $userId }}">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button class="gold-btn px-6 py-3 rounded">Bayar Sekarang</button>
</form>
@endsection
