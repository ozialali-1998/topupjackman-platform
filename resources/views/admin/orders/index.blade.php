@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-yellow-400 mb-4">Order Management</h1>
@foreach($orders as $order)
<div class="gold-card p-4 rounded mb-3 flex justify-between">
    <div>{{ $order->order_id }} - {{ $order->status }} - Rp{{ number_format($order->price,0,',','.') }}</div>
    <form method="post" action="{{ route('admin.orders.status',$order) }}">@csrf @method('PATCH')
        <select name="status" class="bg-zinc-900 border border-yellow-700 rounded px-2 py-1"><option>PENDING</option><option>SUCCESS</option><option>FAILED</option></select>
        <button class="gold-btn px-3 py-1 rounded">Update</button>
    </form>
</div>
@endforeach
{{ $orders->links() }}
@endsection
