@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-yellow-400 mb-6">Pilih Paket Koin</h1>
<form action="{{ route('topup.checkout') }}" method="post">@csrf
    <input name="user_id" value="{{ $userId }}" required placeholder="User ID" class="px-4 py-3 rounded bg-zinc-900 border border-yellow-700 w-full mb-6">
    <div class="grid md:grid-cols-3 gap-4">
        @foreach($products as $product)
        <label class="gold-card p-5 rounded-xl block cursor-pointer">
            <input type="radio" name="product_id" value="{{ $product->id }}" class="mb-3" required>
            <div class="font-semibold">{{ $product->coins }} Coins</div>
            <div class="text-yellow-400">Rp{{ number_format($product->price,0,',','.') }}</div>
        </label>
        @endforeach
    </div>
    <button class="gold-btn px-6 py-3 rounded mt-6">Lanjut Checkout</button>
</form>
@endsection
