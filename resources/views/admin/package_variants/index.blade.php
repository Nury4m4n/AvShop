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
        <div class="col-md-3">
            <label for="departure_date">Tanggal Keberangkatan</label>
            <input type="date" name="departure_date" class="form-control" placeholder="Cari Tanggal Keberangkatan"
                value="{{ request('departure_date') }}">
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
                                <th>Harga Dasar</th>
                                <th>Harga Tambahan</th>
                                <th>Harga Akhir</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Seat Tersedia</th>
                                <th>Seat Terisi</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            @forelse ($variants as $variant)
                                <tr class="hover-row">
                                    <td>{{ $loop->iteration + $variants->firstItem() - 1 }}</td>

                                    <!--<td>{{ $loop->iteration }}</td>-->
                                    <!--<td>-->
                                    <!--    @if ($variant->variant_image)-->
                                    <!--        <img src="{{ asset('storage/' . $variant->variant_image) }}"-->
                                    <!--            alt="{{ $variant->variant }} " width="100">-->
                                    <!--    @else-->
                                    <!--        <span>Tidak ada gambar</span>-->
                                    <!--    @endif-->
                                    <!--</td>-->
                                    <td>{{ $variant->umrahPackage->main_package_name }}</td>
                                    <td>{{ $variant->variant }}</td>

                                    <td>Rp {{ number_format($variant->umrahPackage->price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($variant->price, 0, ',', '.') }}</td>
                                    <td>Rp
                                        {{ number_format($variant->umrahPackage->price + $variant->price, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $variant->departure_date }}</td>
                                    <td>{{ $variant->stock }}</td>
                                    {{-- <td>{{ $variant->stock_taken }}</td> --}}
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
                                            {{-- <button type="button" class="btn btn-primary btn-sm me-1 update-button"
                                                data-bs-toggle="modal" data-bs-target="#updateModal{{ $variant->id }}">
                                                <i class='bx bx-edit-alt'></i> Update Seat
                                            </button> --}}
                                            {{-- <form action="{{ route('package-variants.destroy', $variant->id) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm me-1 delete-button">
                                                    <i class='bx bx-trash'></i> Hapus
                                                </button>
                                            </form> --}}
                                        </div>
                                    </td>

                                    <div class="modal fade" id="updateModal{{ $variant->id }}" tabindex="-1"
                                        aria-labelledby="updateModalLabel{{ $variant->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel{{ $variant->id }}">Update
                                                        Seat untuk {{ $variant->variant }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('package-variants.update-seat', $variant->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Menampilkan pesan error untuk stock -->
                                                        <div class="mb-3">
                                                            <label for="stock" class="form-label">Seat</label>
                                                            <input type="number"
                                                                class="form-control @error('stock') is-invalid @enderror"
                                                                id="stock" name="stock"
                                                                value="{{ old('stock', $variant->stock) }}" required>
                                                            @error('stock')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <!-- Menampilkan pesan error untuk stock_taken -->
                                                        <div class="mb-3">
                                                            <label for="stock_taken" class="form-label">Seat Taken</label>
                                                            <input type="number"
                                                                class="form-control @error('stock_taken') is-invalid @enderror"
                                                                id="stock_taken" name="stock_taken"
                                                                value="{{ old('stock_taken', $variant->stock_taken) }}"
                                                                required>
                                                            @error('stock_taken')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <small class="text-muted">Seat Taken tidak boleh melebihi
                                                                Seat.</small>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Perbarui</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @empty
                                <tr>
                                    <!--<td colspan="10" class="text-center">-->
                                    <!--    <strong>Tidak Ada Data</strong> - Belum ada varian paket umrah yang ditambahkan.-->
                                    <!--</td>-->
                                    <td colspan="9" class="text-center">
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
