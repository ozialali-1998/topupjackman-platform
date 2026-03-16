@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-yellow-400 mb-4">Withdraw Management</h1>
@foreach($withdrawals as $wd)
<div class="gold-card p-4 rounded mb-3 flex justify-between">
    <div>User #{{ $wd->user_id }} - Rp{{ number_format($wd->amount,0,',','.') }} - {{ $wd->status }}</div>
    <form method="post" action="{{ route('admin.withdrawals.status',$wd) }}">@csrf @method('PATCH')
        <select name="status" class="bg-zinc-900 border border-yellow-700 rounded px-2 py-1"><option>Pending</option><option>Approved</option><option>Rejected</option></select>
        <button class="gold-btn px-3 py-1 rounded">Set</button>
    </form>
</div>
@endforeach
{{ $withdrawals->links() }}
@endsection
