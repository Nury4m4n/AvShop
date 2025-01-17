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
        <h1 class="text-center mb-4">Testimoni</h1>
        <div class="card mb-4">
            <div class="card-header bord d-flex justify-content-between align-items-center bg-white  ">
                <h5 class="m-0">Daftar Testimoni</h5>
                <a href="{{ route('testimonials.create') }}" class="btn btn-success btn-sm">
                    Tambah <i class='bx bx-plus'></i>
                </a>
            </div>

            <div class="card-body">
        <form action="{{ route('testimonials.index') }}" method="GET" class="mb-4">
    <div class="row">
        <!-- Input for Name Search -->
        <div class="col-md-10">
            <label for="search-name" class="form-label"> Nama </label>
            <input type="text" name="name" id="search-name" class="form-control" placeholder="Masukkan Nama "
                value="{{ request('name') }}">
        </div>
        
        <!-- Search Button -->
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ route('testimonials.index') }}" class="btn btn-secondary ">Reset</a>
        </div>

    </div>
</form>



                <div class="table-responsive">
                    <table class="table  table-striped text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th style="max-width: 400px;">Pesan</th>
                                <!--<th>profil</th>-->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($testimonials as $testimonial)
                                <tr class="hover-row">
                                    <!--<td>{{ $loop->iteration }}</td>-->
                                    <td>{{ $loop->iteration + $testimonials->firstItem() - 1 }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->date }}</td>
                                    <td style="max-width: 300px;">{{ $testimonial->message }}</td>
                                    <!--<td>-->
                                    <!--    @if ($testimonial->image)-->
                                    <!--        <img src="{{ asset('storage/' . $testimonial->image) }}"-->
                                    <!--            style="max-width: 80px; max-height: 150px; object-fit: contain;"-->
                                    <!--            class="img-thumbnail">-->
                                    <!--    @endif-->
                                    <!--</td>-->


                                    <td>
                                        <div class="btn-group" role="group">

                                            <a href="{{ route('testimonials.edit', $testimonial->id) }}"
                                                class="btn btn-warning btn-sm me-1">
                                                <i class='bx bx-edit'></i> Edit
                                            </a>
                                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}"
                                                method="POST" class="d-inline delete-form">
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
                                    <td colspan="6" class="text-center">
                                        <strong>Tidak Ada Data</strong> - Belum ada Testimoni yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between ">
                    <strong>Total Testimoni : {{ $totalPage }}</strong> {{ $testimonials->links() }}
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
                        title: 'Apakah Anda yakin ingin menghapus testimoni ini?',
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




        .card-header h5 {
            font-weight: bold;
        }


        .hover-row:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
    </style>
@endsection
