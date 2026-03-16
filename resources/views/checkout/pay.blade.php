@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-yellow-400 mb-6">Pembayaran Midtrans</h1>
<div class="gold-card rounded-xl p-6 mb-4">
    <div>Order ID: {{ $order->order_id }}</div>
    <div>Total: Rp{{ number_format($order->total_payment,0,',','.') }}</div>
</div>
<button class="gold-btn px-6 py-3 rounded" id="pay-btn">Bayar Sekarang</button>
<script>
document.getElementById('pay-btn').addEventListener('click', async () => {
    const response = await fetch('{{ route('midtrans.create-transaction') }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'},
        body: JSON.stringify({order_id:'{{ $order->order_id }}'})
    });
    const data = await response.json();
    window.snap.pay(data.token, {
        onSuccess: function(){window.location='{{ route('order-status.index') }}?order_id={{ $order->order_id }}'},
        onPending: function(){window.location='{{ route('order-status.index') }}?order_id={{ $order->order_id }}'},
        onError: function(){alert('Pembayaran gagal')}
    });
});
</script>
@endsection
