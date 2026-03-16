<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Referral;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalTransactions' => Order::count(),
            'totalRevenue' => Order::where('status', 'SUCCESS')->sum('price'),
            'pendingWithdrawals' => Withdrawal::where('status', 'Pending')->count(),
            'totalCommissions' => Referral::sum('commission_amount'),
        ]);
    }
}
