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

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Kelola Pembayaran Cicilan~ </h1>

        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Daftar Pembayaran Cicilan</h5>
            </div>
            <div class="card-body">
                @if ($pendingPayments->isEmpty())
                    <p class="text-muted">Tidak ada pembayaran yang menunggu persetujuan.</p>
                @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pengaju</th>
                                <th>Nama Nasabah</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status Persetujuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingPayments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->savingRelation->user->name }}</td>
                                    <td>{{ $payment->savingRelation->name }}</td>
                                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->approval_status) }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" alt="Bukti Pembayaran"
                                            style="max-width: 150px;">
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.savings.approvePayment', $payment->id) }}"
                                            method="POST">
                                            @csrf
                                            <select name="approval_status" class="form-select w-100" required>
                                                <option value="approved"
                                                    {{ $payment->approval_status == 'approved' ? 'selected' : '' }}>Setujui
                                                </option>
                                                <option value="rejected"
                                                    {{ $payment->approval_status == 'rejected' ? 'selected' : '' }}>Tolak
                                                </option>
                                            </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success btn-sm">Proses</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
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
