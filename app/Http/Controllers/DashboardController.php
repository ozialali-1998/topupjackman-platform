<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\Withdrawal;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('dashboard.index', [
            'wallet' => $user->wallet,
            'referralCount' => Referral::query()->where('user_id', $user->id)->count(),
            'orders' => $user->orders()->latest()->limit(10)->get(),
            'withdrawals' => Withdrawal::query()->where('user_id', $user->id)->latest()->limit(10)->get(),
            'walletTransactions' => $user->wallet->transactions()->latest()->limit(10)->get(),
        ]);
    }
}
