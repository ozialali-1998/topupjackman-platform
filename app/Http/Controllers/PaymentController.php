<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Request $request): JsonResponse
    {
        $request->validate(['order_id' => ['required', 'exists:orders,order_id']]);

        $order = Order::query()->where('order_id', $request->order_id)->firstOrFail();

        $payload = [
            'transaction_details' => [
                'order_id' => $order->order_id,
                'gross_amount' => (int) $order->total_payment,
            ],
            'customer_details' => [
                'first_name' => optional($order->user)->name ?? 'Guest Kako',
                'email' => optional($order->user)->email ?? 'guest@kako.live',
            ],
            'item_details' => [[
                'id' => $order->product_id,
                'price' => (int) $order->price,
                'quantity' => 1,
                'name' => $order->product->name,
            ]],
        ];

        $token = Snap::getSnapToken($payload);

        Payment::updateOrCreate(
            ['order_id' => $order->id],
            ['snap_token' => $token, 'payment_gateway' => 'midtrans', 'payment_status' => 'pending']
        );

        return response()->json(['token' => $token]);
    }

    public function callback(Request $request): JsonResponse
    {
        $notification = new Notification();
        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        $order = Order::query()->where('order_id', $orderId)->firstOrFail();

        if ($transactionStatus === 'settlement') {
            $order->update(['payment_status' => 'settlement', 'status' => 'SUCCESS']);
            $this->processReferralCommission($order);
        } elseif ($transactionStatus === 'pending') {
            $order->update(['payment_status' => 'pending', 'status' => 'PENDING']);
        } elseif (in_array($transactionStatus, ['expire', 'cancel'], true)) {
            $order->update(['payment_status' => $transactionStatus, 'status' => 'FAILED']);
        }

        $order->payment?->update(['payment_status' => $transactionStatus]);

        return response()->json(['ok' => true]);
    }

    private function processReferralCommission(Order $order): void
    {
        if (! $order->user_id) {
            return;
        }

        $buyer = User::find($order->user_id);
        if (! $buyer || ! $buyer->referred_by) {
            return;
        }

        $commission = (int) round($order->price * 0.05);
        $wallet = Wallet::firstOrCreate(['user_id' => $buyer->referred_by], ['balance' => 0]);
        $wallet->increment('balance', $commission);

        WalletTransaction::create([
            'user_id' => $buyer->referred_by,
            'amount' => $commission,
            'type' => 'credit',
            'description' => "Komisi referral dari order {$order->order_id}",
        ]);

        Referral::firstOrCreate(
            ['user_id' => $buyer->referred_by, 'referred_user_id' => $buyer->id],
            ['commission_amount' => 0]
        )->increment('commission_amount', $commission);
    }
}
