@extends('Home.layouts.main')
@section('content')
    <style>
        .mytim {
            display: flex;
            padding: 40px 0px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgba(100, 93, 93, 0.276);
            font-weight: 500;
        }

        .slide-container {
            max-width: 1120px;
            width: 100%;
            padding: 40px 0;
        }

        .slide-content {
            margin: 0 40px;
            overflow: hidden;
            border-radius: 25px;
        }

        .card {
            border-radius: 25px;
            background-color: var(--white);
        }

        .image-content,
        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 14px;
        }

        .image-content {
            position: relative;
            row-gap: 5px;
            padding: 25px 0;
        }

        .overlay {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: var(--maroon1);
            border-radius: 25px 25px 0 25px;
        }

        .overlay::before,
        .overlay::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: -40px;
            height: 40px;
            width: 40px;
            background-color: var(--maroon1);
        }

        .overlay::after {
            border-radius: 0 25px 0 0;
            background-color: var(--white)
        }

        .card-image {
            position: relative;
            height: 150px;
            width: 150px;
            border-radius: 50%;
            background: var(--white);
            padding: 3px;
            cursor: pointer;
        }

        .card-image .card-img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--maroon1);
        }

        .name {
            font-size: 26px;
            font-weight: 500;
            color: var;
        }

        .description {
            font-size: 17px;
            color: var(--maroon1);
            text-align: center;
        }

        .swiper-navBtn {
            color: var(--maroon1);
            transition: color 0.3s ease;
        }

        .swiper-navBtn:hover {
            color: var(--maroon1);
        }

        .swiper-navBtn::before,
        .swiper-navBtn::after {
            font-size: 35px;
        }

        .swiper-button-next {
            right: 0;
        }

        .swiper-button-prev {
            left: 0;
        }

        .swiper-pagination-bullet {
            background-color: var;
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background-color: var(--maroon1);
        }


        /* Popup Styles */
        .popup {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .popup-content {
            top: 40px;
            position: relative;
            height: 80%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .popup-content img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* Ensure the image fits within the popup */
        }

        .popup .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            font-size: 24px;
            cursor: pointer;
            transform: translateY(-50%);
            padding: 10px;
        }

        .nav-btn.left {
            left: 10px;
        }

        .nav-btn.right {
            right: 10px;
        }
    </style>

    {{-- Mytim --}}
    <section>
        <div class="mytim">
            <h1 class="text-center">
                Smarts Team
            </h1>
            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">
                        @foreach ($teamMember as $team)
                            <div class="card swiper-slide">
                                <div class="image-content">
                                    <span class="overlay"></span>
                                    <div class="card-image">
                                        <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}"
                                            class="card-img">
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h2 class="name">{{ $team->name }}</h2>
                                    <p class="description">{{ $team->position }}</p>
                                    <a href="https://api.whatsapp.com/send/?phone=62{{ $team->phone }}"
                                        class="btn text-white pt-2 cusstom-button-wa-home" target="_blank">
                                        <i class='bx bxl-whatsapp bx-tada'></i><span chat-wa-home>
                                            Chat
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Popup for Image -->
        <div id="image-popup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <img id="popup-img" src="" alt="Popup Image">
                <button class="nav-btn left">&#10094;</button>
                <button class="nav-btn right">&#10095;</button>
            </div>
        </div>
    </section>

    {{-- Kontak --}}
    <section>
        <div class="container p-5">
            <h2 class="text-center mb-4">Kontak Kami</h2>
            <div class="row flex-column flex-md-row">
                <div class="col-md-6 px-0">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8143303298716!2d107.6553878750785!3d-6.9127903676564895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e749856dbeab%3A0xf8fdb5c8ba13e918!2sSmarts%20Umrah%20Antapani%20Bandung!5e0!3m2!1sid!2sid!4v1723260953849!5m2!1sid!2sid"
                            width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="regis">
                        <div class="form-container">
                            <p class="title">Message</p>
                            <form id="contact-form" class="form">
                                <input type="text" id="name" name="name" class="form-control mb-3"
                                    placeholder="Name" required>
                                <textarea id="message" name="message" class="form-control mb-3" rows="5" placeholder="Write your message"
                                    required></textarea>
                                <div class="captcha-container row align-items-center mb-3">
                                    <label for="captcha" class="col-form-label col-sm-1">Kode:</label>
                                    <div class="col-sm-11">
                                        <input type="text" id="captcha-display" name="captcha-display"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <input type="text" id="captcha" name="captcha" class="form-control mb-3"
                                    placeholder="Enter code" required>
                                <button type="submit" class="btn form-btn" onclick="sendToWhatsApp()">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
