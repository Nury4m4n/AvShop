@extends('Home.layouts.main')

@section('content')
    <div class="page-umrah-program-bg-blur">
        <section class="container highlight-section">
            <div class="row">
                <h2 class="text-dark lh-lg fs-1 text-center"> AVerseShoop Produk</h2>

                <p class="text-center text-danger font-weight-bolder"></p>

                <div class="card-body">
                    <div class="row">
                        @forelse ($umrahPackages as $umrahPackage)
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="card umrah-card w-auto" style="border: 1px solid #005b5b;">
                                    <img src="{{ asset('storage/' . $umrahPackage->image) }}"
                                        class="card-img-top img-thumbnail" alt="{{ $umrahPackage->main_package_name }}"
                                        style="height: 500px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-center" style="color: #005b5b;">
                                            {{ $umrahPackage->main_package_name }}
                                        </h5>
                                        <h6 class="card-title text-center" style="color: #005b5b;">
                                            Harga Mulai dari Rp {{ number_format($umrahPackage->price, 0, ',', '.') }}
                                        </h6>
                                        <a href="{{ route('home.variants', $umrahPackage->id) }}"
                                            class="btn btn-success mt-auto" style="border-radius: 20px;">
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="development-message text-center">
                                <h2>Belum Ada Produk </h2>
                                <p>Saat ini belum ada produk yang tersedia. Hubungi admin untuk informasi lebih
                                    lanjut!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .development-message {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
