@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('login.submit') }}" class="gold-card p-6 rounded-xl max-w-md mx-auto">@csrf
    <h1 class="text-2xl font-bold text-yellow-400 mb-4">Login</h1>
    <input name="email" type="email" placeholder="Email" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <input name="password" type="password" placeholder="Password" class="w-full mb-3 bg-zinc-900 border border-yellow-700 rounded px-3 py-2">
    <button class="gold-btn px-4 py-2 rounded w-full">Masuk</button>
</form>
@endsection
