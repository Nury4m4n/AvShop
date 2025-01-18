<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageVariant;
use Illuminate\Support\Facades\Storage;
use App\Models\UmrahPackage;

class AdminPackageVariantController extends Controller
{
    public function show($id)
    {
        $packageVariant = PackageVariant::with('umrahPackage')
            ->findOrFail($id);
        return view('admin.package_variants.show', compact('packageVariant'));
    }

    public function index(Request $request)
    {
        // Ambil nilai filter dari request
        $packageName = $request->input('package_name');
        $variantName = $request->input('variant_name');
        $departureDate = $request->input('departure_date');

        // Bangun query dengan filter
        $query = PackageVariant::with(['umrahPackage', 'cartsItem.order'])
            ->when($packageName, function ($query, $packageName) {
                return $query->whereHas('umrahPackage', function ($query) use ($packageName) {
                    $query->where('main_package_name', 'like', '%' . $packageName . '%');
                });
            })
            ->when($variantName, function ($query, $variantName) {
                return $query->where('variant', 'like', '%' . $variantName . '%');
            })
            ->orderBy('created_at', 'desc');

        // Paginate hasil filter
        $variants = $query->paginate(20)->appends([
            'package_name' => $packageName,
            'variant_name' => $variantName,
            'departure_date' => $departureDate
        ]);

        // Hitung total kuantitas dari variant yang memiliki order yang sudah dibayar
        foreach ($variants as $variant) {
            $variant->totalQuantity = $variant->cartsItem
                ->filter(function ($cartItem) {
                    return $cartItem->order && $cartItem->order->status === 'Paid';
                })
                ->sum(function ($cartItem) {
                    return $cartItem->quantity;
                });
        }

        // Total data varian
        $totalPage = $query->count();
        $packages = UmrahPackage::all();

        // Kembalikan hasil view
        return view('admin.package_variants.index', compact('variants', 'packages', 'totalPage'));
    }





    public function create()
    {
        $packages = UmrahPackage::all();
        return view('admin.package_variants.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $umrahPackage = UmrahPackage::findOrFail($request->umrah_package_id);

        $this->validate($request, [
            'umrah_package_id' => 'required|exists:umrah_packages,id',
            'variant' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:99999999999999999999.99',
            'stock' => 'required|integer|min:1',
            'variant_image' => 'nullable|image|max:15360',
            'description' => 'nullable|string',
        ]);

        $existingVariant = PackageVariant::where('umrah_package_id', $request->umrah_package_id)
            ->where('variant', $request->variant)
            ->exists();

        if ($existingVariant) {
            return redirect()->back()->with('error', 'Varian dengan paket ini sudah ada.');
        }

        $variant = new PackageVariant();
        $variant->umrah_package_id = $request->umrah_package_id;
        $variant->variant = $request->variant;
        $variant->price = $request->price;
        $variant->stock = $request->stock;
        $variant->description = $request->input('description'); // Hapus tag HTML dari deskripsi

        if ($request->hasFile('variant_image')) {
            $variant->variant_image = $request->file('variant_image')->store('images', 'public');
        }

        if ($variant->save()) {
            return redirect()->route('package-variants.index')->with('success', 'Varian paket berhasil ditambahkan.');
        } else {
            return redirect()->route('package-variants.index')->with('error', 'Gagal menambahkan varian paket.');
        }
    }

    public function edit($id)
    {
        $packageVariant = PackageVariant::findOrFail($id);
        $packages = UmrahPackage::all();
        return view('admin.package_variants.edit', compact('packageVariant', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $umrahPackage = UmrahPackage::findOrFail($request->umrah_package_id);

        $this->validate($request, [
            'umrah_package_id' => 'required|exists:umrah_packages,id',
            'variant' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:99999999999999999999.99',
            'stock' => 'required|integer|min:1',
            'variant_image' => 'nullable|image|max:15360', // Ganti 'required' menjadi 'nullable'
            'description' => 'nullable|string', // Ubah menjadi 'nullable' jika konten Trix editor bisa kosong
            'hotel_mecca' => 'required|string|max:255',
            'hotel_madinah' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'flight' => 'required|string|max:255',
            'train' => 'nullable|string|max:255',
            'hijri_year' => 'required|integer|min:4',
            'departure_date' => 'required|date|after_or_equal:' . $umrahPackage->start_date,
        ]);

        $variant = PackageVariant::findOrFail($id);

        $existingVariant = PackageVariant::where('umrah_package_id', $request->umrah_package_id)
            ->where('variant', $request->variant)
            ->where('id', '!=', $variant->id)
            ->exists();

        if ($existingVariant) {
            return redirect()->back()->with('error', 'Varian dengan paket ini sudah ada.');
        }

        $variant->umrah_package_id = $request->umrah_package_id;
        $variant->variant = $request->variant;
        $variant->price = $request->price;
        $variant->stock = $request->stock;
        $variant->description = $request->input('description');; // Hapus tag HTML dari deskripsi
        $variant->hotel_mecca = $request->hotel_mecca;
        $variant->hotel_madinah = $request->hotel_madinah;
        $variant->duration_days = $request->duration_days;
        $variant->flight = $request->flight;
        $variant->train = $request->train;
        $variant->hijri_year = $request->hijri_year;
        $variant->departure_date = $request->departure_date;

        if ($request->hasFile('variant_image')) {
            if ($variant->variant_image) {
                Storage::delete('public/' . $variant->variant_image);
            }
            $variant->variant_image = $request->file('variant_image')->store('images', 'public');
        }

        if ($variant->save()) {
            return redirect()->route('package-variants.index')->with('success', 'Varian paket berhasil diperbarui.');
        } else {
            return redirect()->route('package-variants.index')->with('error', 'Gagal memperbarui varian paket.');
        }
    }

    public function destroy($id)
    {
        $variant = PackageVariant::findOrFail($id);

        if ($variant->variant_image) {
            Storage::delete('public/' . $variant->variant_image);
        }

        if ($variant->delete()) {
            return redirect()->route('package-variants.index')->with('success', 'Varian paket berhasil dihapus.');
        } else {
            return redirect()->route('package-variants.index')->with('error', 'Gagal menghapus varian paket.');
        }
    }

    public function updateSeat(Request $request, $id)
    {
        $this->validate($request, [
            'stock' => 'required|integer|min:0',
            'stock_taken' => 'required|integer|min:0|max:' . $request->input('stock'),
        ]);

        $variant = PackageVariant::findOrFail($id);

        $variant->stock = $request->stock;
        $variant->stock_taken = $request->stock_taken;

        if ($variant->save()) {
            return redirect()->route('package-variants.index')->with('success', 'Varian paket berhasil diperbarui.');
        } else {
            return redirect()->route('package-variants.index')->with('error', 'Gagal memperbarui varian paket.');
        }
    }
}
