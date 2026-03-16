@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('register.submit') }}" class="gold-card p-6 rounded-xl max-w-md mx-auto">@csrf
    <h1 class="text-2xl font-bold text-yellow-400 mb-4">Register</h1>
    <input name="name" placeholder="Nama" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <input name="email" type="email" placeholder="Email" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <input name="password" type="password" placeholder="Password" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <input name="ref" value="{{ $ref }}" placeholder="Referral Code (opsional)" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <button class="gold-btn px-4 py-2 rounded w-full">Daftar</button>
</form>
@endsection
