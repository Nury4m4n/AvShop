<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: Times New Roman, Arial, sans-serif;

        }

        main {
            margin: 0;
            padding: 20px;
        }

        .receipt-header {
            margin-top: 20px;
            padding-bottom: 80px;
        }

        .receipt-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-header td {
            vertical-align: middle;
            padding: 5px 0;
        }

        .receipt-header .logo img {
            max-height: 50px;
        }

        .receipt-header .receipt-title {
            text-align: right;
        }

        .receipt-title h1 {
            margin: 0;
            font-size: 20px;
        }

        .receipt-title p {
            margin: 0;
            font-size: 16px;
            color: #555;
            text-align: end;
            font-style: italic;
        }

        .order-info,
        .payment-info,
        .payment-details {
            /* margin-bottom: 20px; */
            margin-bottom: 10px;
        }

        .order-info table,
        .payment-info table,
        .payment-details table {
            /* width: 100%; */
            border-collapse: collapse;
        }

        .payment-details table {
            width: 100%;

        }


        .payment-details td,
        .payment-details th {
            /* padding: 8px 10px; */
            font-size: 16px;
            line-height: 1.5;
            vertical-align: top;
            line-height: normal;
        }

        .order-info th,
        .payment-info th,
        .order-info td,
        .payment-info td {
            font-size: 16px;
            line-height: 1.5;
        }

        .order-info td:nth-child(2n+0) {
            padding-left: 101.5px;
        }

        .payment-info td:nth-child(2n+0) {
            padding-left: 70px;
        }


        .payment-info h2,
        .payment-details h2 {
            font-size: 16px;
            border-bottom: 1px solid black;
            padding-bottom: 10px;
        }

        .payment-details th {
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .payment-details td {
            padding-top: 10px
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <main>

        <header class="receipt-header">
            <table>
                <tr>
                    <td class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    </td>
                    <td class="receipt-title" colspan="2">
                        <h1>Bukti Pembayaran</h1>
                        <p>Payment Receipt</p>
                    </td>
                </tr>
            </table>
        </header>

        <section class="order-info">
            <table>
                <tr>
                    <td>No. Pemesanan</td>
                    <td>: {{ $order->transaction_id }}</td>
                </tr>
                <tr>
                    <td>Tgl. Pemesanan</td>
                    <td>:
                        {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Nama Pemesan</td>
                    <td>: {{ $order->orderer_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $order->orderer_email }}</td>
                </tr>
            </table>
        </section>

        <section class="payment-info">
            <h2>INFO PEMBAYARAN</h2>
            <table>
                <tr>
                    <td>Tanggal Pembayaran</td>
                    <td>: {{ \Carbon\Carbon::parse($order->updated_at)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>: {{ $order->payment_channel }}</td>
                </tr>
                <tr>
                    <td>Total Pembayaran</td>
                    <td>:
                        Rp{{ number_format(
                            $cartItems->sum(function ($item) {
                                return $item->quantity * $item->unit_price;
                            }),
                            0,
                            '.',
                            '.',
                        ) }}
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td style="font-weight: 500">: Lunas</td>
                </tr>
            </table>
        </section>

        <section class="payment-details">
            <h2>RINCIAN PESANAN</h2>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Nama Penerima</th>
                    <th>Paket Umrah</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Total</th>
                </tr>
                @php
                    $itemNumber = 1;
                @endphp

                @foreach ($cartItems->groupBy('package_variant_id') as $variantId => $items)
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $itemNumber++ }}
                            </td>
                            <td>{{ $item->recipient_name }}
                            </td>
                            <td>{{ $item->package }}
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->unit_price, 0, '.', '.') }}
                            </td>
                            <td>Rp{{ number_format($item->quantity * $item->unit_price, 0, '.', '.') }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach

                <tr>
                    <td colspan="3"></td>
                    <td class="text-left"><strong>Total Pemesanan</strong></td>
                    <td><strong>Rp{{ number_format(
                        $cartItems->sum(function ($item) {
                            return $item->quantity * $item->unit_price;
                        }),
                        0,
                        '.',
                        '.',
                    ) }}</strong>
                    </td>
                </tr>
            </table>
        </section>
    </main>

    <div style="width: 100%; position: fixed; bottom: 0; text-align: center;">
        <img src="{{ asset('img/footerpdf.png') }}" alt="Footer"
            style="max-width: 120%; height: auto; margin-bottom: -50px;">
    </div>


    <div class="page-break"></div>
    @foreach ($cartItems->groupBy('package_variant_id') as $variantId => $items)
        @foreach ($items as $item)
            @for ($i = 0; $i < $item->quantity; $i++)
                <main>
                    <header class="receipt-header">
                        <table>
                            <tr>
                                <td class="logo">
                                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                                </td>
                                <td class="receipt-title" colspan="2">
                                    <h1>Bukti Pembayaran</h1>
                                    <p>Payment Receipt</p>
                                </td>
                            </tr>
                        </table>
                    </header>

                    <section class="order-info">
                        <table>
                            <tr>
                                <td>No. Pemesanan</td>
                                <td>: {{ $order->transaction_id }}</td>
                            </tr>
                            <tr>
                                <td>Tgl. Pemesanan</td>
                                <td>: {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pemesan</td>
                                <td>: {{ $item->recipient_name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{ $item->recipient_email }}</td>
                            </tr>
                        </table>
                    </section>

                    <section class="payment-info">
                        <h2>INFO PEMBAYARAN</h2>
                        <table>
                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td>: {{ \Carbon\Carbon::parse($order->updated_at)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>: {{ $order->payment_channel }}</td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td>: Rp{{ number_format($item->quantity * $item->unit_price, 0, '.', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td style="font-weight: 500">: Lunas</td>
                            </tr>
                        </table>
                    </section>

                    <section class="payment-details">
                        <h2>RINCIAN PESANAN</h2>
                        <table>
                            <tr>
                                <th>No.</th>
                                <th>Paket Umrah</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td>1</td> <!-- Karena ini per-item dan per-hal, gunakan nilai tetap -->
                                <td>{{ $item->packageVariant->umrahPackage->main_package_name . ' ' . $item->packageVariant->variant }}
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->unit_price, 0, '.', '.') }}</td>
                                <td>Rp{{ number_format($item->quantity * $item->unit_price, 0, '.', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td><strong>Total Pemesanan</strong></td>
                                <td><strong>Rp{{ number_format($item->quantity * $item->unit_price, 0, '.', '.') }}</strong>
                                </td>
                            </tr>
                        </table>
                    </section>
                </main>

                <div style="width: 100%; position: fixed; bottom: 0; text-align: center;">
                    <img src="{{ public_path('img/footerpdf.png') }}" alt="Footer"
                        style="max-width: 120%; height: auto; margin-bottom: -50px;">
                </div>

                <!-- Menambahkan pemisah halaman untuk setiap item -->
                @if (!($loop->parent->last && $loop->last && $i == $item->quantity - 1))
                    <div class="page-break"></div>
                @endif
            @endfor
        @endforeach
    @endforeach
</body>

</html>
