@extends('Home.layouts.main')
@section('content')
    <section>
        <div class="page-umrah-program-bg">
            <div class="page-umrah-program-bg-blur">
                <div class="container">
                    <h2 class="text-dark lh-lg fs-1 text-center">Program Umrah</h2>
                    <div class="row">
                        @foreach ($variants as $varian)
                            <div class="col-12 col-md-6 col-lg-4 mb-3" style="padding: 0 15px;">
                                <div class="card umrah-card h-100" style="border: 1px solid #005b5b; padding: 10px;">
                                    <img src="{{ asset('storage/' . $varian->variant_image) }}"
                                        class="card-img-top img-thumbnail" alt="{{ $varian->name }}"
                                        style="height: 100%; max-height: 600px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        @if ($varian->variant === 'No Variant')
                                            <h5 class="card-title text-center card-title-variant">
                                                {{ $varian->umrahPackage->main_package_name }}
                                            </h5>
                                        @else
                                            <h5 class="card-title text-center card-title-variant">
                                                {{ $varian->umrahPackage->main_package_name . ' ' . $varian->variant }}
                                            </h5>
                                        @endif
                                        <p class="card-details">
                                            <i class='bx bxs-user-check me-2'></i>
                                            {{ $varian->stock - $varian->stock_taken }}
                                        </p>


                                        <small class="card-details">Harga Paket</small>
                                        <h5>IDR
                                            {{ number_format($varian->umrahPackage->price + $varian->price, 0, ',', '.') }}
                                        </h5>
                                    </div>
                                    <div>
                                        <a href="{{ route('home.variantDetail', $varian->id) }}"
                                            class="btn btn-success mt-2" style="border-radius: 20px; display: block;">
                                            Lihat Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3 pb-3">
                    <a href="{{ route('home.umrahprogram') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back fs-5 me-2'></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
    <style>
        .card-title-variant {
            color: #005b5b;
            border-bottom: 2px solid #005b5b;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .card-details {
            margin-bottom: 2px;
            /* Jarak antara paragraf */
        }

        .umrah-card {
            transition: transform 0.3s ease;
        }

        .umrah-card:hover {
            transform: translateY(-10px);
        }
    </style>
@endsection
