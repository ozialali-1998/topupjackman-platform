<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WithdrawalManagementController extends Controller
{
    public function index(): View
    {
        return view('admin.withdrawals.index', ['withdrawals' => Withdrawal::latest()->paginate(25)]);
    }

    public function updateStatus(Request $request, Withdrawal $withdrawal): RedirectResponse
    {
        $request->validate(['status' => ['required', 'in:Pending,Approved,Rejected']]);

        $withdrawal->update([
            'status' => $request->status,
            'notes' => $request->string('notes')->toString(),
        ]);

        return back()->with('status', 'Status withdraw diperbarui.');
    }
}
