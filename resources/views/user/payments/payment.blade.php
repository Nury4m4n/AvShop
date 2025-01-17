@extends('Home.layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row">
             <!--Grid 1: Pesanan dan Informasi Pemesan -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-maroon text-white text-center">
                        <h4 class="mb-0">Detail Pesanan dan Informasi Pemesan</h4>
                    </div>
                    <div class="card-body">
                         <!-- Ringkasan Pesanan -->
                        <h5 class="fw-bold">Ringkasan Pesanan</h5>
                        
                        @php
                            // Kelompokkan item berdasarkan package_variant_id
                            $groupedCartItems = $cartItems->groupBy('package_variant_id');
                        @endphp

                        @foreach ($groupedCartItems as $variantId => $items)
                            @php
                                // Ambil item pertama dari setiap kelompok untuk mendapatkan detail varian
                                $item = $items->first();
                                // Jumlahkan quantity dari semua item dalam kelompok
                                $totalQuantity = $items->sum('quantity');
                            @endphp
                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                <a href="{{ $item->packageVariant && $item->packageVariant->umrahPackage
                                    ? route('home.variantDetail', $item->packageVariant->umrahPackage->id)
                                    : '#' }}"
                                    title="{{ $item->packageVariant && $item->packageVariant->umrahPackage ? 'Detail Paket' : 'Paket telah dihapus' }}">
                                    <img src="{{ $item->packageVariant && $item->packageVariant->variant_image
                                        ? asset('storage/' . $item->packageVariant->variant_image)
                                        : asset('img/alshafwahcolor.png') }}"
                                        class="img-fluid rounded" width="60"
                                        alt="{{ $item->packageVariant && $item->packageVariant->umrahPackage
                                            ? 'Gambar varian paket'
                                            : 'Gambar tidak tersedia' }}">
                                </a>

                                <div class="ms-3 flex-grow-1">
                                    <a href="{{ $item->packageVariant && $item->packageVariant->umrahPackage
                                        ? route('home.variantDetail', $item->packageVariant->umrahPackage->id)
                                        : '#' }}"
                                        title="{{ $item->packageVariant && $item->packageVariant->umrahPackage ? 'Detail Paket' : 'Paket telah dihapus' }}"
                                        class="text-decoration-none text-dark fw-semibold">
                                        {{ $item->packageVariant->umrahPackage->main_package_name . ' ' . $item->packageVariant->variant }}
                                    </a>
                                </div>
                                <div class="text-end fw-bold">
                                    {{ $totalQuantity }} x
                                    Rp{{ number_format($item->unit_price, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between border-top pt-3 fw-bold mb-4">
                            <span>Total Pesanan:</span>
                            <span>
                                <strong>Rp{{ number_format(
                                    $cartItems->sum(function ($item) {
                                        return $item->quantity * $item->unit_price;
                                    }),
                                    0,
                                    ',',
                                    '.',
                                ) }}</strong>
                            </span>
                        </div>
                        

                         <!-- Informasi Pemesan -->
                        <h5 class="fw-bold">Informasi Pemesan</h5>
                        <div class="border p-3 mb-3">
                            <div class="form-group mb-3">
                                <label for="orderer_name">Nama Pemesan</label>
                                <input type="text" id="orderer_name" name="orderer_name" class="form-control"
                                    value="{{ $order->orderer_name }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="orderer_email">Email Pemesan</label>
                                <input type="email" id="orderer_email" name="orderer_email" class="form-control"
                                    value="{{ $order->orderer_email }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="orderer_phone">Nomor Telepon Pemesan</label>
                                <input type="text" id="orderer_phone" name="orderer_phone" class="form-control"
                                    value="{{ $order->orderer_phone }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="orderer_address">Alamat Pemesan</label>
                                <textarea id="orderer_address" name="orderer_address" class="form-control" rows="3" readonly>{{ $order->orderer_address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          

            <!-- Grid 2: Informasi Penerima -->
            <div class="col-lg-6 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-maroon text-white text-center">
                        <h4 class="mb-0">Informasi Penerima</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($groupedCartItems as $variantId => $items)
                            @foreach ($items as $item)
                                @for ($i = 0; $i < $item->quantity; $i++)
                                    <div class="border p-3 mb-3">
                                        <h6 class="text-muted">Paket:
                                            {{ $item->packageVariant->umrahPackage->main_package_name . ' ' . $item->packageVariant->variant }}
                                        </h6>
                                        <div class="form-group mb-3">
                                            <label for="recipient_name_{{ $item->id }}_{{ $i }}">Nama
                                                Penerima</label>
                                            <input type="text" id="recipient_name_{{ $item->id }}_{{ $i }}"
                                                name="recipient_name[]" class="form-control"
                                                value="{{ $item->recipient_name }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="recipient_email_{{ $item->id }}_{{ $i }}">Email</label>
                                            <input type="email" id="recipient_email_{{ $item->id }}_{{ $i }}"
                                                name="recipient_email[]" class="form-control"
                                                value="{{ $item->recipient_email }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="recipient_phone_{{ $item->id }}_{{ $i }}">Nomor
                                                Telepon</label>
                                            <input type="text" id="recipient_phone_{{ $item->id }}_{{ $i }}"
                                                name="recipient_phone[]" class="form-control"
                                                value="{{ $item->recipient_phone }}" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label
                                                for="recipient_address_{{ $item->id }}_{{ $i }}">Alamat</label>
                                            <textarea id="recipient_address_{{ $item->id }}_{{ $i }}" name="recipient_address[]"
                                                class="form-control" rows="3" readonly>{{ $item->recipient_address }}</textarea>
                                        </div>
                                    </div>
                                @endfor
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="text-end mt-4">
            @if ($order->status === 'Paid')
                <a href="{{ route('cart.downloadReceipt', $order->id) }}" class="btn btn-success" target="_blank">Download
                    Resi PDF</a>
            @else
                <button type="button" class="btn btn-success btn-lg" id="pay-button">Bayar Sekarang</button>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Payment successful!");
                    console.log(result);
                },
                onPending: function(result) {
                    alert("Waiting for payment!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    alert('You closed the payment popup without completing the payment.');
                }
            })
        });
    </script>

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
            background-color: #800000;
            color: #fff;
        }

        .text-end {
            text-align: right;
        }
    </style>
@endsection
