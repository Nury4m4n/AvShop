<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Detail Paket
    public function paymentPage($orderId)
    {
        $order = Order::findOrFail($orderId);
        $snapToken = $order->resi_number;

        // Mengambil semua item keranjang yang terkait dengan user dan order yang diberikan
        $cartItems = CartItem::where('user_id', $order->user_id)
            ->where('order_id', $orderId)
            ->get();

        return view('user.payments.payment', compact('order', 'snapToken', 'cartItems'));
    }

    // Page Belum Bayar
    public function paymentList()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
            ->where('status', '!=', 'Paid')
            ->where('status', '!=', 'failed')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.payments.payment-list', compact('orders'));
    }

    public function PaymentHistory()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
            ->where('status', '!=', 'pending')
            ->where('status', '!=', 'failed')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.payments.payment-histori', compact('orders'));
    }

    public function processCheckout(Request $request)
    {
        $this->validate($request, [
            'orderer_name' => 'required|string|max:255',
            'orderer_email' => 'required|email|max:255',
            'orderer_phone' => 'required|string|max:20',
            'orderer_address' => 'required|string',
        ]);

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong!');
        }

        // Create the order with the orderer details
        $order = Order::create([
            'user_id' => $userId,
            'orderer_name' => $request->input('orderer_name'),
            'orderer_email' => $request->input('orderer_email'),
            'orderer_phone' => $request->input('orderer_phone'),
            'orderer_address' => $request->input('orderer_address'),
            'total_amount' => $cartItems->sum(function ($item) {
                return $item->quantity * ($item->packageVariant->price + $item->packageVariant->umrahPackage->price);
            }),
        ]);

        // Setup Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->orderer_name,
                'last_name' => '',
                'email' => $order->orderer_email,
                'phone' => $order->orderer_phone,
                'address' => $order->orderer_address,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->resi_number = $snapToken;
        $order->save();


        // Simpan setiap penerima ke dalam CartItem
        foreach ($cartItems as $cartItem) {
            for ($i = 0; $i < $cartItem->quantity; $i++) {
                CartItem::create([
                    'order_id' => $order->id,
                    'user_id' => $userId,
                    'package_variant_id' => $cartItem->package_variant_id,
                    'package' => $cartItem->packageVariant->umrahPackage->main_package_name . ' ' . $cartItem->packageVariant->variant,
                    'unit_price' => $cartItem->packageVariant->price + $cartItem->packageVariant->umrahPackage->price,
                    'quantity' => 1,
                    'recipient_name' => $request->input('orderer_name'),
                    'recipient_email' => $request->input('orderer_email'),
                    'recipient_phone' => $request->input('orderer_phone'),
                    'recipient_address' => $request->input('orderer_address'),
                ]);
            }
        }

        Cart::where('user_id', $userId)->delete();
        return redirect()->route('payment.page', $order->id);
    }

    // Callback Midtrans
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $order = Order::find($request->order_id);
            if ($order) {
                $order->transaction_id = $request->transaction_id;

                $order->payment_channel = $request->payment_type;

                if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
                    $order->status = 'Paid';
                } elseif ($request->transaction_status === 'deny' || $request->transaction_status === 'expire' || $request->transaction_status === 'cancel') {
                    $order->status = 'Failed';
                } else {
                    $order->status = 'Pending';
                }

                $order->save();
            }
        }
    }

    public function downloadReceipt(Order $order)
    {
        $data = [
            'order' => $order,
            'cartItems' => $order->cartItems,
        ];

        $pdf = Pdf::loadView('user.payments.receipt', $data);

        return $pdf->download('resi-pembayaran-' . $order->id . '.pdf');
    }
}
