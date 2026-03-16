@extends('layouts.app')
@section('content')
<section class="text-center py-16">
    <h1 class="text-4xl font-black text-yellow-400">Top Up Koin Kako Live</h1>
    <p class="mt-3 text-gray-300">Cepat • Aman • Terpercaya</p>
    <form action="{{ route('topup.index') }}" method="get" class="mt-8 flex gap-3 justify-center">
        <input name="user_id" placeholder="User ID" class="px-4 py-3 rounded bg-zinc-900 border border-yellow-700 w-72">
        <button class="gold-btn px-6 rounded">Mulai Top Up</button>
    </form>
</section>
<section class="grid md:grid-cols-4 gap-4 py-8">
    @foreach(['Proses Instan','Harga Terbaik','Pembayaran Lengkap','Support 24 Jam'] as $feature)
    <div class="gold-card rounded-xl p-5">{{ $feature }}</div>
    @endforeach
</section>
<section class="py-8">
    <h2 class="text-2xl font-bold mb-4">Kako Live</h2>
    <a href="{{ route('topup.index') }}" class="gold-btn px-5 py-3 rounded inline-block">Top Up Sekarang</a>
</section>
<section class="py-8" id="kontak">
    <h3 class="font-bold text-xl mb-3">Metode Pembayaran</h3>
    <div class="flex flex-wrap gap-3 text-sm text-yellow-400">
        @foreach(['QRIS','GoPay','OVO','DANA','BCA','BRI','BNI'] as $pay)
        <span class="gold-card px-4 py-2 rounded">{{ $pay }}</span>
        @endforeach
    </div>
</section>
@endsection
