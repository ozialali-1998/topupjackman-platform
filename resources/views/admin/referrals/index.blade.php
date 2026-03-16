@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-yellow-400 mb-4">Referral Management</h1>
<div class="gold-card p-4 rounded mb-4">Total Komisi: Rp{{ number_format($totalCommissions,0,',','.') }}</div>
@foreach($referrals as $referral)
<div class="gold-card p-3 rounded mb-3">{{ $referral->user->email ?? '-' }} -> {{ $referral->referredUser->email ?? '-' }} | Rp{{ number_format($referral->commission_amount,0,',','.') }}</div>
@endforeach
{{ $referrals->links() }}
@endsection
