@extends('Home.layouts.main')

@section('content')
    <div class="page-umrah-program-bg-blur">
        <section class="container highlight-section">
            <div class="row">
                <h2 class="text-dark lh-lg fs-1 text-center"> Umrah Program </h2>

                <p class="text-center text-danger font-weight-bolder">Tunggu apa lagi!!!</p>
                <div class="card-header d-flex justify-content-center"
                    style="background-color: var(--maroon1); border-radius: 100px; padding: 10px 20px;">
                    <div class="d-block d-md-none w-100">
                        <select id="promo-dropdown" class="form-select" onchange="changeTab(this.value)"
                            style="border-radius: 100px;">
                            <option value="expired">Terlewat</option>
                            <option value="ongoing">Sedang Berjalan</option>
                            <option value="coming-soon">Coming Soon</option>
                        </select>
                    </div>
                    <ul class="nav nav-tabs card-header-tabs d-none d-md-flex pb-2">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="true" href="#expired" data-bs-toggle="tab"
                                onclick="setActiveTab(this)" style="border-radius: 100px;">
                                <i class='bx bx-time-five'></i> Terlewat
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="#ongoing" data-bs-toggle="tab" onclick="setActiveTab(this)"
                                style="border-radius: 100px;">
                                <i class='bx bx-play-circle'></i> Sedang Berjalan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#coming-soon" data-bs-toggle="tab" onclick="setActiveTab(this)"
                                style="border-radius: 100px;">
                                <i class='bx bx-calendar-event'></i> Coming Soon
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body tab-content">
                    <div class="tab-pane fade " id="expired">
                        <div class="row">
                            @forelse ($expiredPackages as $umrahPackage)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card umrah-card w-auto" style="border: 1px solid #005b5b;">

                                        <img src="{{ asset('storage/' . $umrahPackage->image) }}"
                                            class="card-img-top img-thumbnail" alt="{{ $umrahPackage->main_package_name }}"
                                            style="height: 500px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-danger"
                                                style="border-radius: 10px; padding: 5px 10px; font-size: 1.2rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Expired
                                            </span>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-center" style="color: #005b5b;">
                                                {{ $umrahPackage->main_package_name }}
                                            </h5>
                                            <h6 class="card-title text-center" style="color: #005b5b;">
                                                Harga Mulai dari Rp {{ number_format($umrahPackage->price, 0, ',', '.') }}
                                            </h6>
                                            <p class="text-center">
                                                Pendaftaran dari
                                                {{ \Carbon\Carbon::parse($umrahPackage->start_date)->translatedFormat('d F Y') }}
                                                sampai
                                                {{ \Carbon\Carbon::parse($umrahPackage->end_date)->translatedFormat('d F Y') }}
                                            </p>
                                            <a href="{{ route('home.variants', $umrahPackage->id) }}"
                                                class="btn btn-success mt-auto" style="border-radius: 20px;">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <style>
                                    .development-message {
                                        text-align: center;
                                        padding: 20px;
                                        border: 1px solid #dee2e6;
                                        border-radius: 10px;
                                        background-color: #ffffff;
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    }
                                </style>
                                <div class="development-message text-center">
                                    <h2>Program Umrah yang Terlewat</h2>
                                    <p>Sayangnya, tidak ada program Umrah yang dapat Anda ikuti saat ini. Jangan lewatkan
                                        kesempatan berikutnya! Ayo, tanyakan kepada admin tentang paket spesial yang akan
                                        datang!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="tab-pane fade show active" id="ongoing">
                        <div class="row">
                            @forelse ($ongoingPackages as $umrahPackage)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card umrah-card w-auto" style="border: 1px solid #005b5b;">
                                        <img src="{{ asset('storage/' . $umrahPackage->image) }}"
                                            class="card-img-top img-thumbnail" alt="{{ $umrahPackage->main_package_name }}"
                                            style="height: 500px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-success"
                                                style="border-radius: 10px; padding: 5px 10px; font-size: 1.2rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Ongoing
                                            </span>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-center" style="color: #005b5b;">
                                                {{ $umrahPackage->main_package_name }}
                                            </h5>
                                            <h6 class="card-title text-center" style="color: #005b5b;">
                                                Harga Mulai dari Rp {{ number_format($umrahPackage->price, 0, ',', '.') }}
                                            </h6>
                                            <p class="text-center">
                                                Pendaftaran dari
                                                {{ \Carbon\Carbon::parse($umrahPackage->start_date)->translatedFormat('d F Y') }}
                                                sampai
                                                {{ \Carbon\Carbon::parse($umrahPackage->end_date)->translatedFormat('d F Y') }}
                                            </p>
                                            <a href="{{ route('home.variants', $umrahPackage->id) }}"
                                                class="btn btn-success mt-auto" style="border-radius: 20px;">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="development-message text-center">
                                    <h2>Program Umrah Sedang Berjalan</h2>
                                    <p>Sayangnya, tidak ada program Umrah yang dapat Anda ikuti saat ini. Jangan lewatkan
                                        kesempatan berikutnya! Ayo, tanyakan kepada admin tentang paket spesial yang akan
                                        datang!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="tab-pane fade" id="coming-soon">
                        <div class="row">
                            @forelse ($comingSoonPackages as $umrahPackage)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card umrah-card w-auto" style="border: 1px solid #005b5b;">
                                        <img src="{{ asset('storage/' . $umrahPackage->image) }}"
                                            class="card-img-top img-thumbnail" alt="{{ $umrahPackage->main_package_name }}"
                                            style="height: 500px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-warning"
                                                style="border-radius: 10px; padding: 5px 10px; font-size: 1.2rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Coming
                                                Soon </span>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-center" style="color: #005b5b;">
                                                {{ $umrahPackage->main_package_name }}
                                            </h5>
                                            <h6 class="card-title text-center" style="color: #005b5b;">
                                                Harga Mulai dari Rp {{ number_format($umrahPackage->price, 0, ',', '.') }}
                                            </h6>
                                            <p class="text-center">
                                                Pendaftaran dari
                                                {{ \Carbon\Carbon::parse($umrahPackage->start_date)->translatedFormat('d F Y') }}
                                                sampai
                                                {{ \Carbon\Carbon::parse($umrahPackage->end_date)->translatedFormat('d F Y') }}
                                            </p>
                                            <a href="{{ route('home.variants', $umrahPackage->id) }}"
                                                class="btn btn-success mt-auto" style="border-radius: 20px;">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="development-message text-center">
                                    <h2>Program Umrah Coming Soon</h2>
                                    <p>Program Umrah baru akan segera hadir! Pastikan Anda tidak ketinggalan informasi
                                        terkini. Hubungi admin untuk paket spesial yang akan datang!</p>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
    </div>
    </section>
    </div>

    <style>
        .bg-t {
            background-color: rgba(255, 255, 255, 0);
            border: 1px solid rgba(255, 255, 255, 0);
        }

        .nav-link.active {
            color: black;
        }

        .nav-link {
            color: white;
        }
    </style>

    <script>
        function changeTab(tab) {
            const tabs = ['expired', 'ongoing', 'coming-soon'];
            tabs.forEach(t => {
                document.getElementById(t).classList.remove('show', 'active');
            });
            document.getElementById(tab).classList.add('show', 'active');
        }

        function setActiveTab(element) {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            element.classList.add('active');
        }
    </script>
@endsection
