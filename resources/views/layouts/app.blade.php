<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kako Live Top Up' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <style>
        body { background:#080808;color:#f5f5f5; }
        .gold-btn { background:linear-gradient(135deg,#f8d57e,#b78b2d); color:#111; font-weight:700; }
        .gold-card { border:1px solid #a67c2a; background:#121212; }
    </style>
</head>
<body>
    <nav class="border-b border-yellow-800/40 bg-black/80 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="font-bold text-xl text-yellow-400">Kako GoldTopup</a>
            <div class="space-x-4 text-sm">
                <a href="{{ route('landing') }}">Beranda</a>
                <a href="{{ route('topup.index') }}">Cara Top Up</a>
                <a href="{{ route('order-status.index') }}">Panduan</a>
                <a href="#kontak">Kontak</a>
                @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <form class="inline" method="post" action="{{ route('logout') }}">@csrf<button>Logout</button></form>
                @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto p-4">
        @if(session('status'))<div class="bg-green-800/20 border border-green-500 text-green-200 p-3 rounded mb-4">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="bg-red-800/20 border border-red-500 text-red-200 p-3 rounded mb-4">{{ $errors->first() }}</div>@endif
        @yield('content')
    </main>
</body>
</html>
