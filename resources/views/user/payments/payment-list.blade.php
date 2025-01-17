@extends('Home.layouts.main')

@section('content')
    <div class="container">
        <h2 class="p-4 text-center">Belum Bayar</h2>

        @if ($orders->isEmpty())
            <p class="text-muted">Tidak ada pesanan yang ditemukan.</p>
        @else
            <table class="table table-striped">
                <thead class="text-center" style="background: var(--maroon1); color: var(--white)">
                    <tr>
                        <th>No</th>
                        <th>Tangal Pemesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class='text-center'>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->orderer_name }}</td>
                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $order->status }}</td>
                            <!-- Pastikan kolom status ada di tabel orders -->
                            <td class="text-center">
                                <a href="{{ route('payment.page', $order->id) }}" class="btn btn-primary btn-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
