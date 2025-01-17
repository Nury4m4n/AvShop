@extends('Home.layouts.main')
@section('content')
    {{-- Al Shafwah Wisata Mandiri --}}
    <section>
        <div class="page-about-bg-blur p-4">
            <div class="row flex-column-reverse flex-md-row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0 p-5">
                    <h2 class="text-dark lh-lg fs-1">Al Shafwah Wisata Mandiri</h2>
                    <p class="fs-6">
                        PT. Al-Shafwah Wisata Mandiri hadir untuk memberikan solusi “Langsung Berangkat Tanpa Tunggu”
                        dengan banyak pilihan keberangkatan yang akan dengan mudah menyesuaikan jadwal Anda. Perjalanan
                        nyaman dengan maskapai terbaik non transit, hotel terbaik, fasilitas makan fullboard. Pelayanan
                        sebelum keberangkatan, pelayanan selama umrah, hingga jamaah kembali ke Indonesia kami layani
                        sepenuh hati selama 24 jam oleh tim yang profesional dan berkompetensi di bidangnya. PT.
                        Al-Shafwah Wisata Mandiri (Smarts Umrah) adalah anggota, dan juga telah berizin resmi Kemenag
                        dengan nomor 901 tahun 2019.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('img/alshafwahcolor.png') }}" alt="Logo" class="img-fluid hero-image">
                </div>
            </div>
        </div>
    </section>

    {{-- Telah Dipercaya Oleh --}}
    <section>
        <div class="partner">
            <div class="container pt-3">
                <h2 class="text-center text-white fs-2">Telah Dipercaya Oleh</h2>
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    <div class="col">
                        <div class="d-flex justify-content-center align-items-center pt-4 cusstompartnerimg-container">
                            <img src="{{ asset('img/Partner1.png') }}" alt="Logo Perusahaan 1"
                                class="img-fluid cusstompartnerimg">
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-center align-items-center p-4 cusstompartnerimg-container">
                            <img src="{{ asset('img/Partner2.png') }}" alt="Logo Perusahaan 2"
                                class="img-fluid cusstompartnerimg">
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-center align-items-center p-4 cusstompartnerimg-container">
                            <img src="{{ asset('img/Partner3.png') }}" alt="Logo Perusahaan 3"
                                class="img-fluid cusstompartnerimg">
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-center align-items-center p-4 cusstompartnerimg-container">
                            <img src="{{ asset('img/Partner4.png') }}" alt="Logo Perusahaan 4"
                                class="img-fluid cusstompartnerimg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi dan Misi Section --}}
    <section>
        <div class="container p-4">
            <div class="text-center">
                <i class='bx bxs-star section-icon' style="font-size: 50px; color: var(--maroon1);"></i>
                <h2 class="section-title" style="font-weight: bold; font-size: 2.5em; margin-top: 10px;">Visi dan Misi
                </h2>
                <p style="font-size: 1.1em;">Komitmen kami dalam memberikan layanan terbaik</p>
            </div>
            <div class="mb-3" style="font-weight: 500;">
                <h3 class="mb-3" style="color: var(--maroon1);">Visi</h3>
                <p style="font-size: 1.1em;">
                    Smarts Umrah memiliki visi untuk menjadi perusahaan Tour and Travel yang terbaik dan terbesar di
                    Indonesia.
                </p>
            </div>
            <div>
                <h3 class="mb-3" style="color: var(--maroon1); font-weight: 500;">Misi</h3>
                <ul class="list-unstyled" style="font-size: 1.1em; font-weight: 500">
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Menyelenggarakan perjalanan Ibadah Umrah dengan kualitas layanan terbaik untuk mencapai
                        kesempurnaan ibadah.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Mengembangkan wisata regular dan religi sebagai sebuah alternatif perjalanan wisata bagi
                        pelanggan.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Menyelenggarakan ICE tourism dengan pendekatan yang terus berkembang.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Meningkatkan tata kelola perusahaan dengan menerapkan manajemen modern untuk menjadi
                        perusahaan yang efisien dan progresif.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Inovatif dan bekerja keras untuk memberikan pelayanan terbaik kepada segenap pelanggan.
                    </li>
                    <li class="mb-2 d-flex">
                        <i class='bx bxs-check-circle'
                            style="font-size: 20px; color: var(--maroon2); margin-right: 10px;"></i>
                        Memberi manfaat kepada pemegang saham dan karyawan secara berkelanjutan dengan menjadikan
                        perusahaan ini menjadi perusahaan yang menguntungkan.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- KELEBIHAN KAMI --}}
    <section class="advantage-section bg-light">
        <div class="container">
            <h2 class="text-center mb-4">KELEBIHAN KAMI</h2>
            <p class="text-center mb-5">Dapatkan yang terbaik untuk pilihanmu bersama kami</p>
            <div class="row text-center mb-4">
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-file-blank advantage-icon'></i>
                    <h3 class="advantage-title">Legalitas</h3>
                    <p class="advantage-text">
                        Kami adalah travel yang telah berizin PPIU dengan nomor registrasi 735 tahun 2016.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-credit-card advantage-icon'></i>
                    <h3 class="advantage-title">Harga Terbaik</h3>
                    <p class="advantage-text">
                        Dapatkan paket umroh sesuai kebutuhanmu dengan harga yang terbaik & reasonable.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-like advantage-icon'></i>
                    <h3 class="advantage-title">Layanan Terbaik</h3>
                    <p class="advantage-text">
                        Dapatkan layanan terbaik selama 24 jam 7 hari, untuk membantu segala kebutuhanmu.
                    </p>
                </div>
                <!-- Add more items here if needed -->
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-calendar-check advantage-icon'></i>
                    <h3 class="advantage-title">Jadwal Pasti</h3>
                    <p class="advantage-text">
                        Pilih sesuai jadwalmu, kami memiliki banyak keberangkatan yang pasti sesuai dengan jadwalmu.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-plane advantage-icon'></i>
                    <h3 class="advantage-title">Maskapai Terbaik</h3>
                    <p class="advantage-text">
                        Dapatkan perjalanan yang nyaman & menyenangkan dengan maskapai terbaik tanpa transit.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class='bx bxs-heart advantage-icon'></i>
                    <h3 class="advantage-title">Aman & Nyaman</h3>
                    <p class="advantage-text">
                        Anda terlindungi dengan asuransi perjalanan serta keamanan dan kenyamanan selama umrah.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
