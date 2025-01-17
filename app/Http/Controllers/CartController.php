<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PackageVariant;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{



    public function addToCart($packageVariantId)
    {
        $userId = Auth::id();
        $packageVariant = PackageVariant::findOrFail($packageVariantId);

        $cartItem = Cart::where('user_id', $userId)
            ->where('package_variant_id', $packageVariantId)
            ->first();
        if ($cartItem) {
            if ($cartItem->quantity + 1 > ($packageVariant->stock - $packageVariant->stock_taken)) {
                return redirect()->back()->with('error', 'Jumlah kuantitas melebihi stok yang tersedia.');
            }
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            if (1 > ($packageVariant->stock - $packageVariant->stock_taken)) {
                return redirect()->back()->with('error', 'Jumlah kuantitas melebihi stok yang tersedia.');
            }
            Cart::create([
                'user_id' => $userId,
                'package_variant_id' => $packageVariantId,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();
        return view('user.carts.index', compact('cartItems'));
    }

    public function removeFromCart($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang!');
    }

    public function updateQuantity(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($cartId);
        $packageVariant = PackageVariant::findOrFail($cartItem->package_variant_id);

        if ($request->input('quantity') > ($packageVariant->stock - $packageVariant->stock_taken)) {
            return redirect()->back()->with('error', 'Jumlah kuantitas melebihi stok yang tersedia.');
        }

        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
            return redirect()->back()->with('success', 'Kuantitas produk berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang!');
    }

    // Halaman Keranjang
    public function viewCheckout()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();
        $pemesan = UserDetail::where('user_id', $userId)->first();
        return view('user.carts.checkout', compact('cartItems', 'pemesan'));
    }
}
