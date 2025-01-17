@extends('Home.layouts.main')

@section('content')
    <div class="container">
        <h2 class="p-4 text-center">Riwayat Pembayaran</h2>

        <div class="mb-4">
            <p><strong>Paket:</strong> {{ $saving->packageVariant->variant }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($saving->target_amount, 0, ',', '.') }}</p>
            <p><strong>Dibayar:</strong> Rp {{ number_format($saving->current_amount, 0, ',', '.') }}</p>
        </div>

        @if ($payHistories->isEmpty())
            <p class="text-muted">Tidak ada riwayat pembayaran yang ditemukan.</p>
        @else
            <table class="table table-striped">
                <thead class="text-center" style="background: var(--maroon1); color: var(--white)">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payHistories as $history)
                        <tr class='text-center'>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->updated_at->format('d M Y') }}</td>
                            <td>Rp {{ number_format($history->amount, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('savings.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
