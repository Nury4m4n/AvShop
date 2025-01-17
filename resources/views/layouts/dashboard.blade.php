@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <div class="container-fluid py-4">
        <!-- Kartu Informasi -->
        <div class="row mb-4">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-primary text-white shadow-lg border-0 hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <i class='bx bx-package bx-lg me-3'></i>
                        <div>
                            <h5 class="card-title font-weight-bold">Jumlah Paket</h5>
                            <p class="card-text display-4">{{ $jumlahPaket }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-success text-white shadow-lg border-0 hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <i class='bx bx-list-check bx-lg me-3'></i>
                        <div>
                            <h5 class="card-title font-weight-bold">Jumlah Varian</h5>
                            <p class="card-text display-4">{{ $jumlahVarian }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="card bg-warning text-dark shadow-lg border-0 hover-shadow">
                    <div class="card-body d-flex align-items-center">
                        <i class='bx bx-user bx-lg me-3'></i>
                        <div>
                            <h5 class="card-title font-weight-bold">Jumlah Pengguna</h5>
                            <p class="card-text display-4">{{ $jumlahPengguna }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pilihan Paket Utama -->
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="paket_id" class="font-weight-bold">Pilih Paket Utama:</label>
                        <select name="paket_id" id="paket_id" class="form-select">
                            <option value="">Semua Paket</option>
                            @foreach ($umrahPackages as $package)
                                <option value="{{ $package->id }}"
                                    {{ $selectedPaketId == $package->id ? 'selected' : '' }}>
                                    {{ $package->main_package_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </div>
        </form>

        <!-- Grafik Pendapatan -->
        <div class="row mb-4">
            <div class="col-md-12">
                <h3 class="mb-4 text-center font-weight-bold">
                    {{ $selectedPaketId ? 'Pendapatan Varian Paket Umrah' : 'Pendapatan Paket Umrah' }}
                </h3>
                <div class="chart-bar">
                    <canvas id="salesRevenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Laporan Stok Varian Paket -->
        <!--<div class="row">-->
        <!--    <div class="col-md-12">-->
        <!--        <h3 class="mb-4 text-center font-weight-bold">Ketersediaan Stok Varian Paket</h3>-->
        <!--        <div class="table-responsive">-->
        <!--            <table class="table table-striped table-bordered table-hover">-->
        <!--                <thead class="table-dark">-->
        <!--                    <tr>-->
        <!--                        <th>Paket Umrah</th>-->
        <!--                        <th>Varian</th>-->
        <!--                        <th>kursi tersedia</th>-->
        <!--                        <th>kursi Terpakai</th>-->
        <!--                    </tr>-->
        <!--                </thead>-->
        <!--                <tbody>-->
        <!--                    @foreach ($variants as $variant)-->
        <!--                        <tr>-->
        <!--                            <td>{{ $variant->umrahPackage->main_package_name }}</td>-->
        <!--                            <td>{{ $variant->variant }}</td>-->
        <!--                            <td>{{ $variant->stock }}</td>-->
        <!--                            <td>{{ $variant->totalQuantity }}</td>-->
        <!--                        </tr>-->
        <!--                    @endforeach-->
        <!--                </tbody>-->
        <!--            </table>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- Script untuk Grafik -->
        <script>
            // Grafik Pendapatan
            new Chart(document.getElementById('salesRevenueChart'), {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: @json($data),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `Pendapatan: ${tooltipItem.raw.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: '{{ $selectedPaketId ? 'Varian Paket' : 'Paket Umrah' }}',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            ticks: {
                                autoSkip: false
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Pendapatan',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    });
                                }
                            }
                        }
                    }
                }
            });
        </script>

        <!-- CSS untuk ukuran canvas dan efek desain -->
        <style>
            .chart-bar {
                position: relative;
                width: 100%;
                height: 450px;
            }

            .hover-shadow:hover {
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
                transition: box-shadow 0.3s ease;
            }

            .table-hover tbody tr:hover {
                background-color: #f9f9f9;
            }

            @media (max-width: 768px) {
                .card-body {
                    text-align: center;
                }

                .card-body i {
                    display: block;
                    margin-bottom: 10px;
                }

                .chart-bar {
                    height: 300px;
                }

                .btn {
                    font-size: 0.9rem;
                }
            }
        </style>
    </div>
@endsection
