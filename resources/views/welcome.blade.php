@extends('Home.layouts.main')
@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
        <img src="{{ asset('img/home.jpg') }}" alt="smarts">
    </section>

    <section class="galerisection-gallery" style="background-color: var(--white)">
        <div class="container p-3">
            <h1 class="text-center">Galeri</h1>
            <p class="text-center mt-3" style="font-size: 1.25rem;">
                @if ($carousels->isEmpty())
                    Nantikan galeri terbaru kami dan momen-momen istimewa dari para pembeli serta informasi lainnya.
                @else
                    Jangan lewatkan galeri terbaru kami yang menampilkan momen-momen istimewa dari para pembeli.
                @endif
            </p>
            <div class="swiper galerisection-gallery-swiper">
                <div class="swiper-wrapper">
                    @foreach ($carousels as $carousel)
                        <div class="swiper-slide galerisection-swiper-slide">
                            <div class="galerisection-gallery-card card">
                                <img src="{{ asset('storage/' . $carousel->image) }}" class="card-img-top" alt="galeri"
                                    style="width: 100%; height: 400px; object-fit: cover;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- WhatsApp Contact Section --}}
    <section class="bg-light">
        <div class="container-fluid p-5">
            <div class="title d-flex justify-content-center flex-wrap text-center">
                <div class="chat-wa-home-container mb-3">
                    <div class="chat-wa-home-img">
                        <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid" style="max-height: 70px;">
                    </div>
                </div>
                <div class="chat-wa-home">
                    <h2 class="fs-4 pb-3 text-dark">"Punya pertanyaan atau butuh informasi
                        lebih lanjut? Klik di
                        sini untuk berbicara langsung dengan admin dan
                        dapatkan jawaban yang Anda butuhkan!"</h2>
                    <a href="{{ route('home.contact') }}"class="btn text-white pt-2 cusstom-button-wa-home">

                        <i class='bx bxl-whatsapp'></i><span class="text-white">Tanya
                            Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- About Us Section --}}
    <section>
        <div class="container" style="font-weight: 500">
            <div>
                <div class="row flex-column-reverse flex-md-row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                        <h3 class="text-dark lh-lg fs-3">ANGGREK CANTIK UNTUK SEGALA MOMEN</h3>
                        <p class="fs-6">
                            Ingin memberikan sentuhan keindahan alam yang tak terlupakan? Pilih dari berbagai koleksi
                            anggrek kami, mulai dari yang hemat hingga yang eksklusif. Dengan stok yang selalu terjaga, Anda
                            bisa memilih kapan saja sesuai kebutuhan. Sesuai dengan komitmen kami, yaitu "Segar dan Siap
                            Kirim", kami memastikan Anda mendapatkan anggrek berkualitas terbaik tanpa menunggu lama. Jangan
                            lewatkan galeri terbaru kami yang menampilkan koleksi anggrek cantik dan informasi terkini
                            lainnya.
                        </p>
                    </div>

                    <div class="col-md-6 text-center">
                        <img src="/img/logo.png" alt="Logo" class="img-fluid hero-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimoni Section --}}
    <section class="testimonial-carousel bg-light">
        <h2 class="text-center">Testimoni</h2>
        <div class="container"></div>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($testimonials as $index => $testimoni)
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="p-2">
                <div class="connector-line"></div>
            </div>
            <div class="carousel-inner p-2">
                @forelse($testimonials as $index => $testimoni)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="testimonial-card">
                            <div class="message-bubble">
                                <p class="testimonial-text">{{ $testimoni->message }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ $testimoni->image ? asset('storage/' . $testimoni->image) : asset('img/logo.png') }}"
                                    alt="{{ $testimoni->name }}" class="testimonial-photo">
                                <div>
                                    <div class="testimonial-author">{{ $testimoni->name }}</div>
                                    <div class="testimonial-author-date">{{ $testimoni->date }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="testimonial-card">
                            <div class="message-bubble">
                                <p class="testimonial-text">"Pelayanan sangan baik"</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/feri.jpg') }}" alt="Default" class="testimonial-photo">
                                <div>
                                    <div class="testimonial-author">Feri Riana</div>
                                    <div class="testimonial-author-date">1 Agustus 2024</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <button class="carousel-control-prev icon-back" type="button" data-bs-target="#testimonialCarousel"
                data-bs-slide="prev" aria-label="Previous testimonial">
                <i class='bx bxs-chevrons-left bx-fade-left'></i>
            </button>
            <button class="carousel-control-next icon-next" type="button" data-bs-target="#testimonialCarousel"
                data-bs-slide="next" aria-label="Next testimonial">
                <i class='bx bxs-chevrons-right bx-fade-right'></i>
            </button>
        </div>
    </section>
@endsection
