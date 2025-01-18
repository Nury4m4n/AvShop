<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\PackageVariant;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\UmrahPackage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function about()
    {
        return view('Home.pages.about', [
            'meta' => $this->getMetaData(
                'Tentang Kami | AverseShop ',
                'Informasi Lengkap tentang AverseShop  dan Layanan Kami.',
                asset('img/welcome.jpg')
            )
        ]);
    }

    public function contact()
    {
        $teamMember = Team::all();
        return view('Home.pages.contact', [
            'teamMember' => $teamMember,
            'meta' => $this->getMetaData(
                'Kontak Kami | AverseShop ',
                'Hubungi kami untuk informasi lebih lanjut tentang layanan dari AverseShop .',
                asset('img/welcome.jpg')
            )
        ]);
    }

    public function welcome()
    {
        $carousels = Carousel::all();
        $testimonials = Testimonial::all();

        return view('welcome', [
            'testimonials' => $testimonials,
            'carousels' => $carousels,
            'meta' => $this->getMetaData(
                'Selamat Datang di AverseShop ',
                'Produk Berkualitas dari AverseShop : Temukan Layanan Terbaik untuk Kebutuhan Anda.',
                asset('img/welcome.jpg')
            )
        ]);
    }

    public function index()
    {
        $umrahPackages = UmrahPackage::with('packageVariants')->get();

        return view('Home.pages.umrahprogram.umrahprogram', [
            'umrahPackages' => $umrahPackages,
            'meta' => $this->getMetaData(
                'Produk | AverseShop ',
                'Temukan Produk yang Tepat untuk Kebutuhan Anda di AverseShop .',
                asset('img/welcome.jpg')
            )
        ]);
    }

    public function variants($packageId)
    {
        $umrahPackage = UmrahPackage::with('packageVariants')->findOrFail($packageId);
        $variants = $umrahPackage->packageVariants()->get();

        $cartTotalQuantity = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');

        return view('Home.pages.umrahprogram.umrah_program_variant', [
            'umrahPackage' => $umrahPackage,
            'cartTotalQuantity' => $cartTotalQuantity,
            'variants' => $variants,
            'meta' => $this->getMetaData(
                'Variasi Produk | AverseShop ',
                'Lihat variasi produk dari AverseShop .',
                asset('img/welcome.jpg')
            )
        ]);
    }

    public function variantDetail($variantId)
    {
        $variant = PackageVariant::with('umrahPackage')->findOrFail($variantId);
        return view('Home.pages.umrahprogram.umrah_program_variant_detail', [
            'variant' => $variant,
            'meta' => $this->getMetaData(
                $variant->name . ' Detail Produk | AverseShop ',
                'Detail dari variasi produk ' . $variant->name,
                asset($variant->image)
            )
        ]);
    }

    private function getMetaData($title, $description, $image)
    {
        return [
            'title' => $title,
            'description' => Str::limit($description, 160), // Menggunakan Str::limit
            'image' => $image,
            'url' => url()->current(),
        ];
    }
}
