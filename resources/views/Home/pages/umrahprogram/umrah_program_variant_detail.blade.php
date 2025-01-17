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
                        <!--<form action="{{ route('cart.add', $variant->id) }}" method="POST" class="mt-2">-->
                        <!--    @csrf-->
                        <!--    <button type="submit" class="btn btn-primary mt-2"-->
                        <!--        style="border-radius: 20px; display: block; width: 100%">Tambah ke-->
                        <!--        Keranjang</button>-->
                        <!--</form>-->
                        @if(now()->format('Y-m-d') >= $variant->umrahPackage->start_date && now()->format('Y-m-d') < $variant->umrahPackage->end_date)
                        <form action="{{ route('cart.add', $variant->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-success mt-2"
                                style="border-radius: 20px; display: block; width: 100%">Tambah ke
                                Keranjang</button>
                        </form>
                        @endif

                    </div>
                    <div class="col-md-9 col-sm-6">
                        <p class="font-weight-bold mt-4">Apa itu paket {{ $variant->variant }}?</p>
                        <div class="border rounded p-3 bg-light mb-4">
                            <p class="text-muted mb-0">{!! $variant->description !!}</p>
                        </div>
                        @if ($variant->stock - $variant->stock_taken !== 0)
                            <p class="card-details">
                                <i class='bx bxs-user-check me-2'></i> Seat Masih Tersedia
                            </p>
                        @elseif ($variant->stock - $variant->stock_taken === 0)
                            <p class="card-details">
                                <i class='bx bxs-user-check me-2'></i> Seat Full
                            </p>
                        @endif
                        <p class="font-weight-bold">
                            <i class='bx bxs-tag fs-5 me-2'></i> Harga: Rp
                            {{ number_format($variant->umrahPackage->price + $variant->price, 0, ',', '.') }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bxs-calendar-check me-2'></i> Durasi: {{ $variant->duration_days }} hari
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bx-calendar me-2'></i> Tanggal Keberangkatan:
                            {{ \Carbon\Carbon::parse($variant->departure_date)->translatedFormat('d F Y') }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bx-book me-2'></i> Tahun Hijriyah: {{ $variant->hijri_year }}
                        </p>
                        <p class="card-details">
                            <i class='bx bxs-building'></i> {{ $variant->hotel_mecca }} (Makkah)
                        </p>
                        <p class="card-details">
                            <i class='bx bxs-building'></i> {{ $variant->hotel_madinah }} (Madinah)
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bxs-plane-alt me-2'></i> Penerbangan: {{ $variant->flight }}
                        </p>
                        <p class="font-weight-bold">
                            <i class='bx bx-train me-2'></i> Kereta: {{ $variant->train ?? 'Tidak ada detail kereta' }}
                        </p>
                        {{-- <div class=" d-flex justify-content-center">
                            <form action="{{ route('cart.add', $variant->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-primary "
                                    style="border-radius: 20px; white-space: nowrap; width: 500px">Tambah ke
                                    Keranjang</button>
                            </form>
                        </div> --}}
                    </div>
                </div>

                {{-- <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3 py-5">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <a href="{{ route('home.variants', $variant->umrahPackage->id) }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back fs-5 me-2'></i> Kembali
                    </a>
                </div> --}}
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
