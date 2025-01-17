<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function Order(Request $request)
    {
        // Mengambil parameter filter
        $recipientName = $request->input('recipient_name');
        $orderDate = $request->input('order_date');
        $package = $request->input('package');

        $orders = Order::with('cartItems')
            ->when($recipientName, function ($query, $recipientName) {
                return $query->where('orderer_name', 'like', "%{$recipientName}%");
            })
            ->when($orderDate, function ($query, $orderDate) {
                return $query->whereDate('created_at', $orderDate);
            })
            ->when($package, function ($query, $package) {
                return $query->whereHas('cartItems', function ($query) use ($package) {
                    $query->where('package', 'like', "%{$package}%");
                });
            })
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->paginate(20); // Menggunakan pagination

        $totalPage = Order::count(); // Total jumlah data tanpa filter
        return view('admin.orders.order', compact('orders', 'totalPage'));
    }
}
