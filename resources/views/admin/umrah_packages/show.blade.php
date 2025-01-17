@extends('layouts.app')

@section('content')
    <section class="container-fluid">

        <div class="card mb-4 shadow-sm">
            <div class="row g-0">
                <div class="col-md-2">
                    <img src="{{ $package->image ? Storage::url($package->image) : 'https://via.placeholder.com/400x300' }}"
                        alt="{{ $package->main_package_name }}" class="img-thumbnail rounded-start"
                        style="height: 100%; object-fit: cover; ">
                </div>
                <div class="col-md-10 d-flex align-items-center">
                    <div class="card-body">
                        <h1 class="pb-4" style="color: #005b5b;">Detail Paket: {{ $package->main_package_name }}</h1>
                        <p class="card-text">Harga: <strong>Rp {{ number_format($package->price, 2, ',', '.') }}</strong>
                        </p>

                        <p class="card-text">Jumlah Varian: <strong>{{ $totalVariants }}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center pb-4" style="color: #005b5b;">Varian Paket</h2>
        <div class="container">
            <div class="row">

                @forelse($variants as $variant)
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="card umrah-card h-100" style="border: 1px solid #005b5b;">
                            <img src="{{ asset('storage/' . $variant->variant_image) }}" class="card-img-top img-thumbnail"
                                alt="{{ $variant->variant }}" style="height: 100%; max-height: 500px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center" style="color: #005b5b;">
                                    {{ $variant->variant }}</h5>
                                <h6 class="card-title text-center" style="color: #005b5b;">
                                    <a href="{{ route('package-variants.show', $variant->id) }}" class="btn btn-success"
                                        style="padding: 5px 10px; font-size: 1rem; border-radius: 5px;">
                                        Detail
                                    </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Tidak ada varian paket yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{ $variants->links() }} <!-- Pagination -->
    </section>
@endsection
