<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'integer', 'min:50000'],
            'method' => ['required', 'in:bank_transfer,e_wallet'],
            'account_number' => ['required', 'string', 'max:50'],
        ]);

        $wallet = $request->user()->wallet;
        if ($wallet->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Saldo wallet tidak cukup.']);
        }

        Withdrawal::create([
            'user_id' => $request->user()->id,
            'amount' => $validated['amount'],
            'method' => $validated['method'],
            'account_number' => $validated['account_number'],
            'status' => 'Pending',
        ]);

        $wallet->decrement('balance', $validated['amount']);

        WalletTransaction::create([
            'user_id' => $request->user()->id,
            'amount' => $validated['amount'],
            'type' => 'debit',
            'description' => 'Permintaan withdraw',
        ]);

        return back()->with('status', 'Permintaan withdraw berhasil dibuat.');
    }
}
