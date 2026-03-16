<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use Illuminate\View\View;

class ReferralManagementController extends Controller
{
    public function index(): View
    {
        $referrals = Referral::with(['user', 'referredUser'])->latest()->paginate(25);

        return view('admin.referrals.index', [
            'referrals' => $referrals,
            'totalCommissions' => Referral::sum('commission_amount'),
        ]);
    }
}
