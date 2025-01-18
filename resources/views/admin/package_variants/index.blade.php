@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Input',
                    html: `
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            `,
                    showConfirmButton: true,
                    confirmButtonText: 'Perbaiki'
                });
            });
        </script>
    @endif
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4">Varian Paket Umrah</h1>
        <div class="card mb-4">
            <div class="card-header bord d-flex justify-content-between align-items-center bg-white border-0">
                <h5 class="m-0 text-dark">Daftar Varian Paket Umrah</h5>
                <a href="{{ route('package-variants.create') }}" class="btn btn-success btn-sm">
                    Tambah<i class='bx bx-plus'></i>
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('package-variants.index') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="package_name">Nama Paket</label>
                            <input type="text" name="package_name" class="form-control" placeholder="Cari Nama Paket"
                                value="{{ request('package_name') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="variant_name">Nama Varian</label>
                            <input type="text" name="variant_name" class="form-control" placeholder="Cari Nama Varian"
                                value="{{ request('variant_name') }}">
                        </div>

                        <div class="col-md-2 d-flex justify-content-center align-items-end">
                            <button type="submit" class="btn btn-primary me-1">Filter</button>
                            <a href="{{ route('package-variants.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>



                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!--<th>Brosur</th>-->
                                <th>Nama Paket</th>
                                <th>Nama Varian</th>
                                <th>Harga </th>
                                <th>Seat Tersedia</th>
                                <th>Seat Terisi</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            @forelse ($variants as $variant)
                                <tr class="hover-row">
                                    <td>{{ $loop->iteration + $variants->firstItem() - 1 }}</td>


                                    <td>{{ $variant->umrahPackage->main_package_name }}</td>
                                    <td>{{ $variant->variant }}</td>

                                    <td>Rp
                                        {{ number_format($variant->umrahPackage->price + $variant->price, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $variant->stock }}</td>
                                    <td>
                                        {{ $variant->totalQuantity }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('package-variants.show', $variant->id) }}"
                                                class="btn btn-info btn-sm me-1">
                                                <i class='bx bx-show'></i> Detail
                                            </a>
                                            <a href="{{ route('package-variants.edit', $variant->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class='bx bx-edit'></i> Edit
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <strong>Tidak Ada Data</strong> - Data Tidak di Temukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between ">
                    <strong>Total Varian Paket : {{ $totalPage }}</strong>
                    {{ $variants->links() }}
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin menghapus varian ini?',
                        text: "Tindakan ini tidak dapat dibatalkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

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

        .card-header h5 {
            font-weight: bold;
        }


        .hover-row:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
    </style>
@endsection
