@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-yellow-400 mb-4">Product Management</h1>
<form method="post" action="{{ route('admin.products.store') }}" class="gold-card p-4 rounded grid md:grid-cols-4 gap-2 mb-5">@csrf
    <input name="name" placeholder="Name" class="bg-zinc-900 border border-yellow-700 rounded px-2 py-1">
    <input name="coins" type="number" placeholder="Coins" class="bg-zinc-900 border border-yellow-700 rounded px-2 py-1">
    <input name="price" type="number" placeholder="Price" class="bg-zinc-900 border border-yellow-700 rounded px-2 py-1">
    <button class="gold-btn rounded">Tambah</button>
</form>
@foreach($products as $product)
<div class="gold-card p-3 rounded mb-3">{{ $product->name }} - {{ $product->coins }} - Rp{{ number_format($product->price,0,',','.') }}</div>
@endforeach
@endsection
