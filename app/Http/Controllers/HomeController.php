<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\PackageVariant;
use App\Models\Team;
use App\Models\Promo;
use App\Models\Testimonial;
use App\Models\UmrahPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function about()
    {
        return view('Home.pages.about', [
            'meta' => $this->getMetaData(
                'Tentang Kami | Smarts Umrah Bandung',
                'Informasi Lengkap tentang Smart Umrah Bandung dan Layanan Umrah Kami.',
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
                'Kontak Kami | Smarts Umrah Bandung',
                'Hubungi kami untuk informasi lebih lanjut tentang layanan umrah dari Smarts Umrah Bandung.',
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
                'Selamat Datang di Smarts Umrah Bandung',
                'Paket Umrah Berkualitas dari Smart Umrah Bandung: Temukan Layanan Terbaik untuk Perjalanan Ibadah Anda.',
                asset('img/welcome.jpg')
            )
        ]);
    }

    private function getPromoStatus($promo, $currentDateTime)
    {
        $closingTime = Carbon::parse($promo->closing_hour);
        $promoDate = Carbon::parse($promo->start_date);
        $openingTime = Carbon::parse($promo->opening_hour);

        $isExpired = $currentDateTime > $promoDate->setTimeFromTimeString($openingTime->toTimeString()) &&
            $currentDateTime > $promoDate->setTimeFromTimeString($closingTime->toTimeString());
        $isOngoing = $currentDateTime > $promoDate->setTimeFromTimeString($openingTime->toTimeString()) &&
            $currentDateTime < $promoDate->setTimeFromTimeString($closingTime->toTimeString());
        $isComingSoon = $currentDateTime < $promoDate;

        if ($isExpired) {
            return 'expired';
        } elseif ($isOngoing) {
            return 'ongoing';
        } elseif ($isComingSoon) {
            return 'comingSoon';
        }

        return null;
    }

    public function index()
    {
        $umrahPackages = UmrahPackage::with('packageVariants')->get();
        $currentDateTime = now();

        $expiredPackages = [];
        $ongoingPackages = [];
        $comingSoonPackages = [];

        foreach ($umrahPackages as $umrahPackage) {
            $packageStatus = $this->getUmrahPackageStatus($umrahPackage, $currentDateTime);

            if ($packageStatus === 'expired') {
                $expiredPackages[] = $umrahPackage;
            } elseif ($packageStatus === 'ongoing') {
                $ongoingPackages[] = $umrahPackage;
            } elseif ($packageStatus === 'comingSoon') {
                $comingSoonPackages[] = $umrahPackage;
            }
        }

        return view('Home.pages.umrahprogram.umrahprogram', [
            'expiredPackages' => $expiredPackages,
            'ongoingPackages' => $ongoingPackages,
            'comingSoonPackages' => $comingSoonPackages,
            'meta' => $this->getMetaData(
                'Paket Umrah | Smarts Umrah Bandung',
                'Temukan Paket Umrah yang Tepat untuk Kebutuhan Anda di Smart Umrah Bandung',
                asset('img/welcome.jpg')
            )
        ]);
    }

    private function getUmrahPackageStatus($umrahPackage, $currentDateTime)
    {
        $startDate = Carbon::parse($umrahPackage->start_date);
        $endDate = Carbon::parse($umrahPackage->end_date);

        $isExpired = $currentDateTime > $endDate;
        $isOngoing = $currentDateTime >= $startDate && $currentDateTime <= $endDate;
        $isComingSoon = $currentDateTime < $startDate;

        if ($isExpired) {
            return 'expired';
        } elseif ($isOngoing) {
            return 'ongoing';
        } elseif ($isComingSoon) {
            return 'comingSoon';
        }

        return null;
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
                'Variasi Paket Umrah | Smarts Umrah Bandung',
                'Lihat variasi paket untuk umrah dari Smarts Umrah Bandung.',
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
                $variant->name . ' Detail Paket Umrah | Smarts Umrah Bandung',
                'Detail dari paket variasi umrah ' . $variant->name,
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