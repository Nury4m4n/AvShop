<!-- resources/views/admin/savings/history.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">History Pembayaran Nasabah: {{ $saving->name }}</h1>

        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Daftar Pembayaran</h5>
            </div>
            <div class="card-body">
                @if ($payments && $payments->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $payment->updated_at }}
                                    </td>
                                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->approval_status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Belum ada riwayat pembayaran untuk nasabah ini.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
