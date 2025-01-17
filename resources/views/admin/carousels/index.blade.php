@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 5000,
                timerProgressBar: true
            });
        </script>
    @endif

    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4">Galeri</h1>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                <h5 class="m-0">Daftar Galeri</h5>
                <a href="{{ route('carousels.create') }}" class="btn btn-success btn-sm">
                    Tambah<i class='bx bx-plus'></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            @forelse ($carousels as $carousel)
                                <tr class="hover-row">
                                    <!--<td>{{ $loop->iteration }}</td>-->
                                    <td>{{ $loop->iteration + $carousels->firstItem() - 1 }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}"
                                            style="max-width: 80px; max-height: 150px; object-fit: contain;"
                                            class="img-thumbnail">
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('carousels.edit', $carousel->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class='bx bx-edit'></i> Edit
                                            </a>
                                            <form action="{{ route('carousels.destroy', $carousel->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-button">
                                                    <i class='bx bx-trash'></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <strong>Tidak Ada Data</strong> - Belum ada item carousel ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table> --}}
                </div>
                <div class="d-flex justify-content-between ">
                    <strong>Total Galeri : {{ $totalPage }}</strong> {{ $carousels->links() }}
                    <!-- Menampilkan pagination -->
                </div>
            </div>
        </div>
    </div>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#tbl_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    }, {
                        data: 'image',
                        name: 'image'
                    },

                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin menghapus item ini?',
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
