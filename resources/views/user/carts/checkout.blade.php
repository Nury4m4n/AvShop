@extends('Home.layouts.main')

@section('content')
    <div class="container py-4">
        <div class="text-center pb-4">
            <h2>Checkout</h2>
        </div>

        @if ($cartItems->isEmpty())
            <p class="text-center">Keranjang Anda kosong.</p>
        @else
            <div class="row">
                <!-- Ringkasan Pesanan -->
                <div class="col-lg-5 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-maroon text-white">
                            <h4 class="mb-0 text-center">Ringkasan Pesanan</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($cartItems as $item)
                                <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                                    <a href="{{ route('home.variantDetail', $item->packageVariant->umrahPackage->id) }}">
                                        <img src="{{ asset('storage/' . $item->packageVariant->variant_image) }}"
                                            alt="{{ $item->packageVariant->name }}" width="60">
                                    </a>
                                    <div class="ms-3 flex-grow-1">
                                        <a href="{{ route('home.variantDetail', $item->packageVariant->umrahPackage->id) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $item->packageVariant->umrahPackage->main_package_name . ' ' . $item->packageVariant->variant }}
                                        </a>
                                    </div>
                                    <div class="text-end fw-bold">
                                        {{ $item->quantity }} x
                                        Rp{{ number_format($item->packageVariant->price + $item->packageVariant->umrahPackage->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between border-top pt-3 fw-bold">
                                <span>Total Pesanan:</span>
                                <span>
                                    Rp{{ number_format(
                                        $cartItems->sum(function ($item) {
                                            return $item->quantity * ($item->packageVariant->price + $item->packageVariant->umrahPackage->price);
                                        }),
                                        0,
                                        ',',
                                        '.',
                                    ) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Pengiriman -->
                <div class="col-lg-7 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-maroon text-white">
                            <h4 class="mb-0 text-center">Informasi Pemesan & Penerima</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cart.checkout.process') }}" method="POST">
                                @csrf

                                <!-- Informasi Pemesan -->
                                <div class="border p-3 mb-3">
                                    <h5 class="text-muted">Informasi Pemesan</h5>
                                    <div class="form-group">
                                        <label for="orderer_name">Nama Pemesan</label>
                                        <input type="text" id="orderer_name" name="orderer_name" class="form-control"
                                            value="{{ $pemesan->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="orderer_email">Email Pemesan</label>
                                        <input type="email" id="orderer_email" name="orderer_email" class="form-control"
                                            value="{{ auth()->user()->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="orderer_phone">Nomor Telepon Pemesan</label>
                                        <input type="text" id="orderer_phone" name="orderer_phone" class="form-control"
                                            value="{{ $pemesan->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="orderer_address">Alamat Pemesan</label>
                                        <textarea id="orderer_address" name="orderer_address" class="form-control" required>{{ $pemesan->address }}</textarea>
                                    </div>
                                </div>

                                <!-- Informasi Penerima -->
                                @php
                                    $recipientNumber = 1; // Inisialisasi penomoran penerima
                                @endphp

                                @foreach ($cartItems as $item)
                                    @for ($i = 0; $i < $item->quantity; $i++)
                                        <div class="border p-3 mb-3">
                                            <h5 class="text-muted">Penerima #{{ $recipientNumber }}</h5>
                                            <h6 class="text-muted">Paket:
                                                {{ $item->packageVariant->umrahPackage->main_package_name . ' ' . $item->packageVariant->variant }}
                                            </h6>
                                            <div class="form-group">
                                                <label for="recipient_name_{{ $item->id }}_{{ $i }}">Nama
                                                    Penerima</label>
                                                <input type="text"
                                                    id="recipient_name_{{ $item->id }}_{{ $i }}"
                                                    name="recipient_name[]" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="recipient_email_{{ $item->id }}_{{ $i }}">Email</label>
                                                <input type="email"
                                                    id="recipient_email_{{ $item->id }}_{{ $i }}"
                                                    name="recipient_email[]" class="form-control" value="{{ auth()->user()->email }}" required  readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient_phone_{{ $item->id }}_{{ $i }}">Nomor
                                                    Telepon</label>
                                                <input type="text"
                                                    id="recipient_phone_{{ $item->id }}_{{ $i }}"
                                                    name="recipient_phone[]" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="recipient_address_{{ $item->id }}_{{ $i }}">Alamat</label>
                                                <textarea id="recipient_address_{{ $item->id }}_{{ $i }}" name="recipient_address[]"
                                                    class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        @php
                                            $recipientNumber++;
                                        @endphp
                                    @endfor
                                @endforeach

                                <button type="submit" class="btn btn-primary float-end">Buat Pesanan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .border-bottom {
            border-bottom: 1px solid #ddd;
        }

        .border-top {
            border-top: 1px solid #ddd;
        }

        .fw-bold {
            font-weight: bold;
        }

        .card-header {
            background-color: var(--maroon1);
            color: var(--white);
        }

        .text-end {
            text-align: right;
        }
    </style>
@endsection
