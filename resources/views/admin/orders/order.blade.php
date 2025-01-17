@extends('layouts.app')

@section('content')
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

        ol {
            padding-left: 20px;
            margin: 0;
        }

        ol li {
            margin-bottom: 5px;
            text-align: left;
        }
 .modal {
        z-index: 9999; /* Default Bootstrap z-index untuk modal */
    }

    .modal-backdrop {
        z-index: 9998; /* Backdrop tetap di bawah modal */
    }
        .modal-dialog {
            max-width: fit-content; /* Modal menyesuaikan lebar konten */
            margin: auto;
        }

        .modal-body table {
            width: auto; /* Tabel hanya selebar konten */
            border-collapse: collapse;
        }

        .modal-body table th, .modal-body table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .modal-body table thead {
            background-color: var(--maroon1);
        }
    </style>

    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4">Status Pesanan</h1>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                <h5 class="m-0 text-dark">Daftar Pesanan</h5>
            </div>
            <div class="card-body">
                <!-- Formulir Filter -->
                <form method="GET" action="{{ route('order') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="recipient_name" class="form-control" placeholder="Nama Pemesan"
                                value="{{ request('recipient_name') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="order_date" class="form-control" placeholder="Tanggal Pemesanan"
                                value="{{ request('order_date') }}">
                        </div>
                        <!--<div class="col-md-3">-->
                        <!--    <input type="text" name="package" class="form-control" placeholder="Paket"-->
                        <!--        value="{{ request('package') }}">-->
                        <!--</div>-->
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('order') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Detail</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="hover-row">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $order->orderer_name }}</td>
                                    <td>
                                        <!-- Button untuk membuka modal -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                            Detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Detail Pesanan untuk {{ $order->orderer_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Penerima</th>
                                                                    <th>No HP</th>
                                                                    <th>Paket</th>
                                                                    <!--<th>Quantity</th>-->
                                                                    <th>Harga Satuan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $totalQuantity = 0; @endphp
                                                                @foreach ($order->cartItems as $item)
                                                                    <tr>
                                                                         <td class="text-center">{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->recipient_name }}</td>
                                                                        <td>
                                                                            <a href="https://api.whatsapp.com/send/?phone=62{{ $item->recipient_phone }}">
                                                                                {{ $item->recipient_phone }}
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ $item->package }}</td>
                                                                        <!--<td>{{ $item->quantity }}</td>-->
                                                                        <td>Rp{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                                                    </tr>
                                                                    @php $totalQuantity += $item->quantity; @endphp
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="mt-3">
                                                            <strong>Total Jumlah Pesanan: {{ $totalQuantity }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($order->status == 'Paid')
                                            <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                        @elseif ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                                        @elseif ($order->status == 'failed')
                                            <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <strong>Tidak Ada Data</strong> - Data Tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between">
                    <strong>Total Pesanan: {{ $totalPage }}</strong>
                    {{ $orders->links() }} <!-- Menampilkan pagination -->
                </div>
            </div>
        </div>
    </div>
@endsection
