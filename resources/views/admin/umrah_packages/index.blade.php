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
                <p class='text-center'>{{ $error }}</p>
            @endforeach
            `,
                });
            });
        </script>
    @endif
    <div class="container-fluid mt-4">

        <h1 class="text-center mb-4">Paket Umrah</h1>
        <div class="card mb-4">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 text-dark">Daftar Paket Umrah</h5>
                    <a href="{{ route('umrah-packages.create') }}" class="btn btn-success btn-sm">
                        Tambah <i class='bx bx-plus'></i>
                    </a>
                </div>
                <form action="{{ route('umrah-packages.index') }}" method="GET">
                    <div class="row align-items-end g-3">
                        <div class="col-md-4">
                            <label for="name" class="form-label">Nama Paket</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Cari Nama Paket" value="{{ request('name') }}">
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('umrah-packages.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!--<th>Brosur</th>-->
                                <th>Nama Paket Utama</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($packages as $package)
                                <tr class="hover-row">
                                    <td>{{ $loop->iteration + $packages->firstItem() - 1 }}</td>
                                    <td>{{ $package->main_package_name }}</td>
                                    <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('umrah-packages.show', $package->id) }}"
                                                class="btn btn-info btn-sm me-1">
                                                <i class='bx bx-show'></i> Detail
                                            </a>
                                            <a href="{{ route('umrah-packages.edit', $package->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class='bx bx-edit'></i> Edit
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>

                                    <td colspan="6" class="text-center">
                                        <strong>Tidak Ada Data</strong> - Data Tidak di Temukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between ">
                    <strong>Total Paket : {{ $totalPage }}</strong> {{ $packages->links() }}
                    <!-- Menampilkan pagination -->
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
                        title: 'Apakah Anda yakin ingin menghapus paket ini?',
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
