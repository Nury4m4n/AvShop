@extends('Home.layouts.main')

@section('content')
    <section class="container-fluid p-5 bg-white">
        <div class="p-3">
            @if ($variant->variant === 'No Variant')
                <h2 class="text-center">Paket: {{ $variant->umrahPackage->main_package_name }}
                </h2>
            @else
                <h2 class="text-center">Paket: {{ $variant->umrahPackage->main_package_name }} Varian:
                    {{ $variant->variant }}
                </h2>
            @endif

        </div>

        <div class="row">
            <div class="col-12">
                <div class="row align-items-start">
                    <div class="col-md-3 col-sm-6 text-center">
                        @if ($variant->variant_image)
                            <img src="{{ asset('storage/' . $variant->variant_image) }}"
                                class="img-fluid rounded border border-light shadow-sm" alt="{{ $variant->variant }}"
                                style="object-fit: cover; width: 100%; height: auto;">
                        @else
                            <div class="text-center">
                                <p class="text-muted">Tidak ada gambar tersedia</p>
                            </div>
                        @endif
                        <form action="{{ route('cart.add', $variant->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-success mt-2"
                                style="border-radius: 20px; display: block; width: 100%">Tambah ke
                                Keranjang</button>
                        </form>

                    </div>
                    <div class="col-md-9 col-sm-6">~
                        <p class="font-weight-bold mt-4">Apa itu paket {{ $variant->variant }}?</p>
                        <div class="border rounded p-3 bg-light mb-4">
                            <p class="text-muted mb-0">{!! $variant->description !!}</p>
                        </div>
                        <p class="card-details">
                            <i class='bx bxs-user-check me-2'></i>Stok Tersedia {{ $variant->stock - $variant->stock_taken }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bxs-tag fs-5 me-2'></i> Harga: Rp
                            {{ number_format($variant->umrahPackage->price + $variant->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .card-details {
            margin-bottom: 2px;
        }
    </style>
@endsection
