@extends('Home.layouts.main')
@section('content')
    {{-- Toko Bunga Anggrek --}}
    <section>
        <div class="page-about-bg-blur p-4">
            <div class="row flex-column-reverse flex-md-row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0 p-5">
                    <h2 class="text-dark lh-lg fs-1">AVerseShoop</h2>
                    <p class="fs-6">
                        AVerseShoop hadir untuk melengkapi setiap momen istimewa Anda dengan rangkaian bunga
                        berkualitas
                        tinggi. Kami menyediakan berbagai jenis bunga segar dan layanan pengiriman bunga yang dapat
                        diandalkan.
                        Dengan tim profesional dan berpengalaman, kami memastikan setiap produk kami dirangkai dengan penuh
                        cinta
                        dan perhatian terhadap detail.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Toko Bunga Anggrek" class="img-fluid hero-image">
                </div>
            </div>
        </div>
    </section>

    {{-- Visi dan Misi Section --}}
    <section>
        <div class="container p-4">
            <div class="text-center">
                <i class='bx bxs-flower section-icon' style="font-size: 50px; color: var(--maroon1);"></i>
                <h2 class="section-title" style="font-weight: bold; font-size: 2.5em; margin-top: 10px;">Visi dan Misi</h2>
                <p style="font-size: 1.1em;">Komitmen kami dalam menghadirkan keindahan melalui bunga</p>
            </div>
            <div class="mb-3" style="font-weight: 500;">
                <h3 class="mb-3" style="color: var(--maroon1);">Visi</h3>
                <p style="font-size: 1.1em;">
                    Menjadi toko bunga pilihan utama di Indonesia, dengan layanan terbaik dan rangkaian bunga berkualitas
                    tinggi.
                </p>
            </div>
            <div>
                <h3 class="mb-3" style="color: var(--maroon1); font-weight: 500;">Misi</h3>
                <ul class="list-unstyled" style="font-size: 1.1em; font-weight: 500">
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Memberikan rangkaian bunga yang indah dan segar untuk setiap kesempatan.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Menyediakan layanan pengiriman bunga yang cepat dan andal.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Menciptakan pengalaman belanja bunga yang mudah dan menyenangkan bagi pelanggan.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Memberikan pelayanan ramah dan profesional kepada setiap pelanggan.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Produk dan Layanan --}}
    <section class="advantage-section bg-light">
        <div class="container">
            <h2 class="text-center mb-4">PRODUK DAN LAYANAN</h2>
            <p class="text-center mb-5">Temukan berbagai pilihan bunga segar kami</p>
            <div class="row text-center mb-4">
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-leaf advantage-icon'></i>
                    <h3 class="advantage-title">Produk Berkualitas</h3>
                    <p class="advantage-text">
                        Hanya bunga segar dan terbaik yang kami pilih untuk Anda.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-package advantage-icon'></i>
                    <h3 class="advantage-title">Packaging Aman</h3>
                    <p class="advantage-text">
                        Setiap produk dikemas dengan hati-hati agar tetap segar dan utuh hingga sampai di tangan Anda.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-time advantage-icon'></i>
                    <h3 class="advantage-title">Pengiriman Tepat Waktu</h3>
                    <p class="advantage-text">
                        Kami pastikan bunga Anda tiba tepat waktu untuk momen spesial Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
