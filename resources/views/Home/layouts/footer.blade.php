<footer class="footer-bg text-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4 footer-logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Perusahaan">
                {{-- <div class="social-icons">
                    <a href="#" class="footer-link me-2" aria-label="Instagram">
                        <i class='bx bxl-instagram-alt'></i>
                    </a>
                    <a href="#" class="footer-link me-2" aria-label="Facebook">
                        <i class='bx bxl-facebook-circle'></i>
                    </a>
                    <a href="#" class="footer-link me-2" aria-label="Twitter">
                        <i class='bx bxl-twitter'></i>
                    </a>
                    <a href="#" class="footer-link" aria-label="YouTube">
                        <i class='bx bxl-youtube'></i>
                    </a>
                </div> --}}
            </div>

            <div class="col-md-4">
                <h5>Hubungi Kami</h5>
                <table class="contact-table">
                    <tr>
                        <td><i class='bx bxs-map'></i></td>
                        <td><a href="https://maps.app.goo.gl/8ANjx5P9pQynR6k18" class="footer-link" target="_blank">
                                Neglasari, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40124
                            </a>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td><i class='bx bxs-envelope'></i></td>
                        <td>Email: <a href="mailto:smartsmudamandiri@gmail.com" class="footer-link"
                                target="_blank">smartsmudamandiri@gmail.com</a>
                        </td>
                    </tr> --}}
                    <tr>
                        <td><i class='bx bxs-phone'></i></td>
                        <td>Telp:
                            <a href="https://api.whatsapp.com/send/?phone=6282311377490" class="footer-link"
                                target="_blank">
                                +6282311377490
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4">
                <h5 class="mb-2">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('welcome') }}" class="footer-link" aria-label="Beranda">
                            <i class='bx bx-chevron-right'></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home.about') }}" class="footer-link" aria-label="Tentang Kami">
                            <i class='bx bx-chevron-right'></i> Tentang Kami
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('home.umrahprogram') }}" class="footer-link" aria-label="Program Umrah">
                            <i class='bx bx-chevron-right'></i> Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home.contact') }}" class="footer-link" aria-label="Kontak">
                            <i class='bx bx-chevron-right'></i> Kontak
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center py-3">
        {{-- <p>&copy; AVerseShoop All rights reserved | Developed by Nuryaman.</p> --}}
        <p>&copy; AVerseShoop All rights reserved</p>
    </div>
</footer>
