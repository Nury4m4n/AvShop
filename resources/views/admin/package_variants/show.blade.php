@extends('layouts.app')

@section('content')
    <section class="container-fluid mb-5">
        <div class="p-3">
            <h2 class="text-center">Paket: {{ $packageVariant->umrahPackage->main_package_name }} Varian:
                {{ $packageVariant->variant }}</h2>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row align-items-start">
                    <div class="col-md-3 col-sm-6 text-center">
                        @if ($packageVariant->variant_image)
                            <img src="{{ asset('storage/' . $packageVariant->variant_image) }}"
                                class="img-fluid rounded border border-light shadow-sm" alt="{{ $packageVariant->variant }}"
                                style="object-fit: cover; width: 100%; height: auto;">
                        @else
                            <div class="text-center">
                                <p class="text-muted">Tidak ada gambar tersedia</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-9 col-sm-6">
                        <p class="font-weight-bold mt-4">Apa itu paket {{ $packageVariant->variant }}?</p>
                        <div class="border rounded p-3 bg-light mb-4">
                            <p class="text-muted mb-0"> {!! $packageVariant->description !!}
                            </p>
                        </div>
                        <p class="font-weight-bold">
                            <i class='bx bxs-user-check me-2'></i> Kursi Tersedia: {{ $packageVariant->stock }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bx-money me-2'></i> Harga Dasar: Rp
                            {{ number_format($packageVariant->umrahPackage->price, 0, ',', '.') }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bx-money-withdraw me-2'></i> Harga Tambahan: Rp
                            {{ number_format($packageVariant->price, 0, ',', '.') }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bxs-tag fs-5 me-2'></i> Harga Akhir: Rp
                            {{ number_format($packageVariant->umrahPackage->price + $packageVariant->price, 0, ',', '.') }}
                        </p>
                       
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back fs-5 me-2'></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .card-details {
            margin-bottom: 2px;
            /* Jarak antara paragraf */
        }
    </style>
@endsection
