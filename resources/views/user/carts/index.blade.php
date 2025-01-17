@extends('Home.layouts.main')

@section('content')
    <div class="page-umrah-program-bg-blur">

        <div class="container py-4">
            <div class="text-center pb-3">
                <h2>Keranjang Belanja</h2>
            </div>

            @if ($cartItems->isEmpty())
                <p class="text-center">Keranjang Anda kosong.</p>
            @else
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center" style="background-color: var(--maroon1); color: var(--white)">
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr class="text-center">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a
                                                    href="{{ route('home.variantDetail', $item->packageVariant->umrahPackage->id) }}">
                                                    <img src="{{ asset('storage/' . $item->packageVariant->variant_image) }}"
                                                        alt="{{ $item->packageVariant->name }}" width="100">
                                                </a>
                                                <div class="ms-3">
                                                    <a href="{{ route('home.variantDetail', $item->packageVariant->umrahPackage->id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $item->packageVariant->umrahPackage->main_package_name . ' ' . $item->packageVariant->variant }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            Rp{{ number_format($item->packageVariant->price + $item->packageVariant->umrahPackage->price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group">
                                                    {{-- <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        min="1" class="form-control"> --}}
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        class="form-control">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-end">
                                            Rp{{ number_format($item->packageVariant->price + $item->packageVariant->umrahPackage->price * $item->quantity, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="border-bottom-custom"></tr>
                                <tr>
                                    <td colspan="3" class="text-center fw-bold border-bottom-0">Total Pesanan:</td>
                                    <td colspan="1" class="text-end border-bottom-0 fw-bold">
                                        Rp{{ number_format(
                                            $cartItems->sum(function ($item) {
                                                return $item->quantity * ($item->packageVariant->price + $item->packageVariant->umrahPackage->price);
                                            }),
                                            0,
                                            ',',
                                            '.',
                                        ) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end border-bottom-0">
                                        <a href="{{ route('cart.checkout') }}" class="btn btn-success">
                                            <i class='bx bx-cart'></i> Checkout
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <style>
        .border-bottom-custom {
            border-bottom: 3px solid #000;
        }

        td,
        th {
            white-space: nowrap;
            vertical-align: middle;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
@endsection
