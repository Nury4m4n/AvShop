<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="copyright" content="AverseShop">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    {{-- SEO Meta Tags --}}
    <meta name="description"
        content="{{ \Illuminate\Support\Str::limit($meta['description'] ?? 'AverseShop, penyedia berbagai produk berkualitas dengan harga terjangkau. Temukan koleksi terbaik untuk Anda.', 160) }}">
    <meta name="keywords"
        content="anggrek, bunga anggrek, AverseShop, koleksi anggrek, promo anggrek, tanaman hias, bunga eksotis">
    <meta name="author" content="AverseShop">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $meta['url'] ?? url('/') }}">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $meta['title'] ?? 'Koleksi Berkualitas | AverseShop' }}">
    <meta property="og:description"
        content="{{ \Illuminate\Support\Str::limit($meta['description'] ?? 'Dapatkan koleksi terbaik dan eksklusif hanya di AverseShop.', 200) }}">
    <meta property="og:image" content="{{ $meta['image'] ?? asset('img/logo.jpg') }}">
    <meta property="og:url" content="{{ $meta['url'] ?? url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="AverseShop">
    <meta property="og:image:alt" content="Gambar produk dari AverseShop">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['title'] ?? 'Koleksi Berkualitas | AverseShop' }}">
    <meta name="twitter:description"
        content="{{ \Illuminate\Support\Str::limit($meta['description'] ?? 'Jelajahi koleksi terbaik dan eksklusif hanya di AverseShop.', 200) }}">
    <meta name="twitter:image" content="{{ $meta['image'] ?? asset('img/logo.jpg') }}">
    <meta name="twitter:site" content="@averseshop">
    <meta name="twitter:creator" content="@averseshop">
    <meta name="twitter:url" content="{{ $meta['url'] ?? url('/') }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}>
    <link rel="icon"
        type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}>
    <link rel="icon"
        type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">


    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/load.css') }}">

    {{-- Boxicons for Icons --}}
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
    <meta name="theme-color" content="#451541">

    {{-- Title --}}
    <title>{{ $meta['title'] ?? 'Koleksi Berkualitas | AverseShop' }}</title>

</head>

<body>
    {{-- Welcome Text --}}
    <div class="welcome-text">
        Tersedia berbagai produk. Dapatkan promo yang menarik, terbatas!
        <a href="{{ route('home.umrahprogram') }}">Lihat disini <i data-feather="arrow-right"></i></a>
    </div>

    {{-- Navigation Bar --}}
    @include('Home.layouts.navbar')

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('Home.layouts.footer')

    {{-- Loading Overlay --}}
    {{-- <div id="loading" class="loading-overlay">
        <div class="dot-spinner">
            <div class="load"></div>
            <div class="load"></div>
            <div class="load"></div>
            <div class="load"></div>
            <div class="load"></div>
            <div class="load"></div>
            <div class="load"></div>
            <div class="load"></div>
        </div>
    </div> --}}

    {{-- SweetAlert2 JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- Custom JavaScript --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Bootstrap Bundle with Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
