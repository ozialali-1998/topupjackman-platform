@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-yellow-400 mb-6">Admin Dashboard</h1>
<div class="grid md:grid-cols-5 gap-3">
    <div class="gold-card p-4 rounded">Users: {{ $totalUsers }}</div>
    <div class="gold-card p-4 rounded">Transactions: {{ $totalTransactions }}</div>
    <div class="gold-card p-4 rounded">Revenue: Rp{{ number_format($totalRevenue,0,',','.') }}</div>
    <div class="gold-card p-4 rounded">Pending WD: {{ $pendingWithdrawals }}</div>
    <div class="gold-card p-4 rounded">Commissions: Rp{{ number_format($totalCommissions,0,',','.') }}</div>
</div>
@endsection
