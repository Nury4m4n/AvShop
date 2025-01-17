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

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Kelola Pengajuan Nasabah - Semua Nasabah</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Daftar Semua Nasabah</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengaju</th>
                            <th>Nama Nasabah</th>
                            <th>Paket</th>
                            <th>Harga Paket</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($savings as $saving)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $saving->user->name }}</td>
                                <td>{{ $saving->name }}</td>
                                <td>{{ $saving->packageVariant->variant }}</td>
                                <td>Rp {{ number_format($saving->target_amount, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($saving->approval_status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

        .card-header h5 {
            font-weight: bold;
        }

        .hover-row:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
    </style>
@endsection
