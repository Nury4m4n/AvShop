<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUmrahPackageRequest;
use App\Http\Requests\UpdateUmrahPackageRequest;
use App\Models\UmrahPackage;
use App\Models\User;
use App\Models\PackageVariant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminUmrahPackageController extends Controller
{
    public function create()
    {
        return view('admin.umrah_packages.create');
    }

    public function index(Request $request)
    {
        $query = UmrahPackage::with('packageVariants')->orderBy('created_at', 'desc');

        // Filter berdasarkan Nama Paket
        if ($request->filled('name')) {
            $query->where('main_package_name', 'like', '%' . $request->name . '%');
        }

        // Paginate hasil filter
        $packages = $query->paginate(20);

        // Total paket setelah filter
        $totalPage = $query->count();

        return view('admin.umrah_packages.index', compact('packages', 'totalPage'));
    }



    public function store(StoreUmrahPackageRequest $request)
    {
        $this->validate($request, [
            'main_package_name' => 'required|unique:umrah_packages|string|max:255',
            'image' => 'nullable|image|max:15360',
            'price' => 'required|numeric|min:0|max:99999999999999999999.99',
        ]);

        $package = new UmrahPackage();
        $package->main_package_name = $request->main_package_name;

        if ($request->hasFile('image')) {
            $package->image = $request->file('image')->store('brosur', 'public');
        }

        $package->save();

        return redirect()->route('umrah-packages.index')->with('success', 'Paket Umrah berhasil ditambahkan.');
    }

    public function show($id)
    {
        $package = UmrahPackage::with('packageVariants')->findOrFail($id);
        $variants = $package->packageVariants()->paginate(3);
        $totalVariants = $package->packageVariants()->count();
        return view('admin.umrah_packages.show', compact('package', 'variants', 'totalVariants'));
    }

    public function edit($id)
    {
        $package = UmrahPackage::findOrFail($id);
        return view('admin.umrah_packages.edit', compact('package'));
    }

    public function update(UpdateUmrahPackageRequest $request, $id)
    {
        $this->validate($request, [
            'main_package_name' => 'nullable|string|max:255|unique:umrah_packages,main_package_name,' . $id,
            'image' => 'nullable|image|max:15360',
            'price' => 'required|numeric|min:0|max:99999999999999999999.99',
        ]);

        $package = UmrahPackage::findOrFail($id);
        $package->main_package_name = $request->main_package_name;
        $package->price = $request->price;

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::delete('public/' . $package->image);
            }
            $package->image = $request->file('image')->store('brosur', 'public');
        }


        $package->save();

        return redirect()->route('umrah-packages.index')->with('success', 'Paket Umrah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $package = UmrahPackage::findOrFail($id);

        if ($package->packageVariants->count() > 0) {
            return redirect()->route('umrah-packages.index')->with('error', 'Paket Umrah tidak dapat dihapus karena memiliki varian.');
        }

        if ($package->image) {
            Storage::delete('public/' . $package->image);
        }

        if ($package->delete()) {
            return redirect()->route('umrah-packages.index')->with('success', 'Paket Umrah berhasil dihapus.');
        } else {
            return redirect()->route('umrah-packages.index')->with('error', 'Paket Umrah gagal dihapus.');
        }
    }

    public function dashboard(Request $request)
    {
        $paketId = $request->input('paket_id');

        // Data Jumlah
        $jumlahPaket = UmrahPackage::count();
        $jumlahVarian = PackageVariant::count();
        $jumlahPengguna = User::count();

        // Data Paket Umrah
        $umrahPackages = UmrahPackage::with('packageVariants')->get();

        // Filter berdasarkan paket yang dipilih
        if ($paketId) {
            // Ambil paket yang dipilih beserta variannya
            $selectedPackage = UmrahPackage::with('packageVariants.cartsItem.order')
                ->find($paketId);

            // Hitung total pendapatan dari varian paket yang dipilih
            $salesData = $selectedPackage->packageVariants->map(function ($variant) {
                // Hitung total kuantitas varian yang terjual
                $totalQuantity = $variant->cartsItem
                    ->filter(function ($cartItem) {
                        return $cartItem->order && $cartItem->order->status === 'Paid';
                    })
                    ->sum('quantity');

                // Hitung total pendapatan
                $totalRevenue = ($variant->price + $variant->umrahPackage->price) * $totalQuantity;

                return [
                    'name' => $variant->variant,
                    'total_revenue' => $totalRevenue
                ];
            });
        } else {
            // Jika semua paket dipilih, hitung total pendapatan dari semua varian
            $salesData = $umrahPackages->map(function ($package) {
                $totalRevenue = $package->packageVariants->sum(function ($variant) {
                    $totalQuantity = $variant->cartsItem
                        ->filter(function ($cartItem) {
                            return $cartItem->order && $cartItem->order->status === 'Paid';
                        })
                        ->sum('quantity');

                    return ($variant->price + $variant->umrahPackage->price) * $totalQuantity;
                });

                return [
                    'name' => $package->main_package_name,
                    'total_revenue' => $totalRevenue
                ];
            });
        }

        // Semua varian untuk ditampilkan di tabel
        $variants = PackageVariant::with(['cartsItem.order'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        foreach ($variants as $variant) {
            $variant->totalQuantity = $variant->cartsItem
                ->filter(function ($cartItem) {
                    return $cartItem->order && $cartItem->order->status === 'Paid';
                })
                ->sum(function ($cartItem) {
                    return $cartItem->quantity;
                });
        }
        // Filter varian jika paket tertentu dipilih
        if ($paketId) {
            $variants = $variants->where('umrah_package_id', $paketId);
        }

        // Ambil label dan data untuk chart
        $labels = $salesData->pluck('name');
        $data = $salesData->pluck('total_revenue');

        // Kembalikan data ke tampilan
        return view('layouts.dashboard', [
            'jumlahPaket' => $jumlahPaket,
            'jumlahVarian' => $jumlahVarian,
            'jumlahPengguna' => $jumlahPengguna,
            'labels' => $labels,
            'data' => $data,
            'variants' => $variants,
            'umrahPackages' => UmrahPackage::all(),
            'selectedPaketId' => $paketId
        ]);
    }
}
