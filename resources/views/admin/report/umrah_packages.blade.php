@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="mb-5">
            <h1 class="text-center">Laporan Penjualan AverseShop</h1>
        </div>

        <form method="GET" action="{{ route('report.umrah-packages') }}" class="mb-4">
            <div class="row mb-3">
                <div class="col-md-8">
                    <input type="text" name="package_name" class="form-control" placeholder="Nama Paket"
                        value="{{ request('package_name') }}">
                </div>

                <div class="col-md-4">
                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('report.umrah-packages') }}" class="btn btn-secondary">Reset Filter</a>
                        <a href="{{ route('export.umrah-packages', ['package_name' => request('package_name')]) }}"
                            class="btn btn-success">Download Laporan</a>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Nama Varian</th>
                        <th>Harga Dasar</th>
                        <th>Harga Tambahan</th>
                        <th>Harga Akhir</th>
                        <th>Stok Tersedia</th>
                        <th>Produk Terjual</th>
                        <th>Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rowNumber = 1; @endphp
                    @foreach ($umrahPackages as $umrahPackage)
                        @foreach ($umrahPackage->packageVariants as $variant)
                            <tr>
                                <td>{{ $rowNumber++ }}</td>
                                <td>{{ $umrahPackage->main_package_name }}</td>
                                <td>{{ $variant->variant }}</td>
                                <td>Rp {{ number_format($umrahPackage->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($variant->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($umrahPackage->price + $variant->price, 0, ',', '.') }}</td>
                                <td>{{ $variant->stock }}</td>
                                <td>{{ $variant->totalQuantity }}</td>
                                <td>{{ $variant->stock - $variant->totalQuantity }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        thead {
            background-color: var(--maroon1);
            color: var(--white);
        }

        td,
        th {
            white-space: nowrap;
            vertical-align: middle;
        }

        .hover-row:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
    </style>
@endsection
