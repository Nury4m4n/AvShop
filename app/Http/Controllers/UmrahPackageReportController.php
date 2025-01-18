<?php

namespace App\Http\Controllers;

use App\Models\UmrahPackage;
use Illuminate\Http\Request;
use App\Exports\UmrahPackagesExport;
use Maatwebsite\Excel\Facades\Excel;

class UmrahPackageReportController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input filter dari request
        $packageName = $request->input('package_name');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Membangun query dasar untuk paket Umrah
        $query = UmrahPackage::with('packageVariants');

        // Menambahkan filter jika ada input
        if ($packageName) {
            $query->where('main_package_name', 'LIKE', '%' . $packageName . '%');
        }

        if ($startDate) {
            $query->where('start_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('end_date', '<=', $endDate);
        }

        // Mendapatkan data paket Umrah berdasarkan filter
        $umrahPackages = $query->get();

        // Iterasi setiap umrahPackage untuk menghitung totalQuantity dari setiap varian
        foreach ($umrahPackages as $umrahPackage) {
            foreach ($umrahPackage->packageVariants as $variant) {
                // Menghitung totalQuantity dari setiap varian
                $variant->totalQuantity = $variant->cartsItem
                    ->filter(function ($cartItem) {
                        return $cartItem->order && $cartItem->order->status === 'Paid';
                    })
                    ->sum(function ($cartItem) {
                        return $cartItem->quantity;
                    });
            }
        }

        // Mengembalikan view dengan data yang difilter
        return view('admin.report.umrah_packages', compact('umrahPackages'));
    }

    public function export(Request $request)
    {
        // Mengambil input filter dari request
        $packageName = $request->input('package_name');

        // Membangun query dasar untuk paket Umrah
        $query = UmrahPackage::with('packageVariants');

        // Menambahkan filter jika ada input
        if ($packageName) {
            $query->where('main_package_name', 'LIKE', '%' . $packageName . '%');
        }

        // Mendapatkan data paket Umrah berdasarkan filter
        $umrahPackages = $query->get();

        // Membuat instance dari UmrahPackagesExport dengan data
        $export = new UmrahPackagesExport($umrahPackages);

        // Mengunduh file Excel
        return Excel::download($export, 'laporan-paket-umrah.xlsx');
    }
}
