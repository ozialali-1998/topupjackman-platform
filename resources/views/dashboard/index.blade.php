@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-yellow-400 mb-6">User Dashboard</h1>
<div class="grid md:grid-cols-3 gap-4 mb-6">
    <div class="gold-card p-4 rounded">Wallet: Rp{{ number_format($wallet->balance,0,',','.') }}</div>
    <div class="gold-card p-4 rounded">Referral Count: {{ $referralCount }}</div>
    <div class="gold-card p-4 rounded">Referral Link: {{ url('/register?ref='.auth()->user()->referral_code) }}</div>
</div>
<div class="gold-card rounded-xl p-5 mb-6">
    <h2 class="font-bold mb-3">Withdraw</h2>
    <form method="post" action="{{ route('withdrawals.store') }}" class="grid md:grid-cols-3 gap-3">@csrf
        <input name="amount" type="number" min="50000" placeholder="Amount" class="bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
        <select name="method" class="bg-zinc-900 border border-yellow-700 rounded px-3 py-2"><option value="bank_transfer">Bank transfer</option><option value="e_wallet">E-wallet</option></select>
        <input name="account_number" placeholder="Account Number" class="bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
        <button class="gold-btn px-4 py-2 rounded">Request Withdraw</button>
    </form>
</div>
@endsection
