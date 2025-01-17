@extends('Home.layouts.main')

@section('content')
    <div class="container">
        <h2 class="p-4 text-center">Daftar Tabungan</h2>

        <a href="{{ route('savings.create') }}" class="btn btn-primary mb-3">Ajukan Cicilan Baru</a>

        @if ($savings->isEmpty())
            <p class="text-muted">Tidak ada cicilan yang ditemukan.</p>
        @else
            <table class="table table-striped">
                <thead class="text-center" style="background: var(--maroon1); color: var(--white)">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Dibayar</th>
                        <th>Status Pengajuan</th>
                        <th>Status Cicilan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($savings as $saving)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $saving->name }}</td>
                            <td>{{ $saving->packageVariant->variant }}</td>
                            <td>Rp {{ number_format($saving->target_amount, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($saving->current_amount, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($saving->approval_status) }}</td>
                            <td>
                                @if ($saving->approval_status === 'rejected')
                                    Rejected
                                @else
                                    {{ ucfirst($saving->status) }}
                                @endif
                            </td>
                            <td>
                                @if ($saving->approval_status === 'approved' && $saving->status !== 'completed')
                                    <a href="{{ route('savings.pay', $saving->id) }}"
                                        class="btn btn-success btn-sm">Bayar</a>
                                @endif
                                <a href="{{ route('savings.history', $saving->id) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
