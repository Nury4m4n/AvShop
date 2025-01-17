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
        <h1 class="text-center mb-4">Daftar Anggota Tim</h1>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                <h5 class="m-0 text-dark">Daftar Anggota Tim</h5>
                <a href="{{ route('teams.create') }}" class="btn btn-success btn-sm">
                    Tambah Anggota Tim <i class='bx bx-plus'></i>
                </a>
            </div>
            <div class="card-body">
 <form method="GET" action="{{ route('teams.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-5 mb-3">
            <label for="name" class="form-label">Nama Anggota</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Cari berdasarkan nama"
                value="{{ request()->get('name') }}">
        </div>
        <div class="col-md-5 mb-3">
            <label for="position" class="form-label">Jabatan</label>
            <input type="text" id="position" name="position" class="form-control" placeholder="Cari berdasarkan jabatan"
                value="{{ request()->get('position') }}">
        </div>
        <div class="col-md-2 d-flex align-items-end mb-3">
            <button type="submit" class="btn btn-primary  me-1">Filter</button>
            <a href="{{ route('teams.index') }}" class="btn btn-secondary ">Reset</a>
        </div>
    </div>
</form>


                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Anggota</th>
                                <th>Jabatan</th>
                                <th>phone</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teamMembers as $team)
                                <tr class="hover-row">
                                    <!--<td>{{ $loop->iteration }}</td>-->
                                    <td>{{ $loop->iteration + $teamMembers->firstItem() - 1 }}</td>
                                    <td>
                                        @if ($team->image)
                                            <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}"
                                                width="100">
                                        @else
                                            <span>Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->position }}</td>
                                    <td>{{ $team->phone }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            {{-- <a href="{{ route('teams.show', $team->id) }}" class="btn btn-info btn-sm me-1">
                                                <i class='bx bx-show'></i> Lihat
                                            </a> --}}
                                            <a href="{{ route('teams.edit', $team->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class='bx bx-edit'></i> Edit
                                            </a>
                                            <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
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
                                        <strong>Tidak Ada Data</strong> - Belum ada anggota tim yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between">
                    <strong>Total Anggota Tim : {{ $totalPage }}</strong> {{ $teamMembers->links() }}
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
                        title: 'Apakah Anda yakin ingin menghapus anggota tim ini?',
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
