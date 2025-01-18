<div class="navbar-brand">
    <div class="logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/navbar.png') }}" alt="Smarts Umrah Bandung">
        </a>
    </div>
    <button class="menu-toggle" aria-label="Toggle menu">
        <i class='bx bx-menu' id="menuIcon"></i>
    </button>
    <div class="nav-brand-link">
        <ul>
            <li>
                <td>
                    <i class='bx bx-check' style='color:#451541; font-weight: bold; font-size: 21px;'></i>
                    <span class="title-brand">
                        Penjualan
                    </span>
                </td>
                <td>
                    <p class="title-brand2">1.000+</p>
                </td>
            </li>

            <li>
                <td>
                    <i class='bx bx-check' style='color:#451541; font-weight: bold; font-size: 21px;'></i>
                    <span class="title-brand">
                        No 1 Di Bandung
                    </span>
                </td>
                <td>
                    <p class="title-brand2">
                        Toko Terpercaya
                    </p>
                </td>
            </li>
        </ul>
    </div>
</div>
<div class="navbar">
    <div class="nav-links">
        <ul>
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li><a href="{{ route('home.about') }}">Tentang Kami</a></li>
            <li><a href="{{ route('home.umrahprogram') }}">Produk</a></li>
            <li><a href="{{ route('home.contact') }}">Kontak</a></li>
            <li><a href="{{ route('cart.view') }}" class=" position-relative">
                    <i class='bx bx-cart fs-4'></i>
                    @php
                        $cartTotalQuantity = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                    @endphp
                    @if ($cartTotalQuantity > 0)
                        <span class="position-absolute top-0 start-150 translate-middle badge rounded-pill bg-danger">
                            {{ $cartTotalQuantity }}
                            <span class="visually-hidden ">items</span>
                        </span>
                    @endif
                </a>
            </li>
            @auth

                <li class="dropdown">
                    <button class="dropdown-toggle" aria-expanded="false">
                        <i class='bx bx-user-circle'></i> Welcome back, {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">Setting</li>
                        <li><a href="{{ route('user_details.index') }}" class="dropdown-item"><i class='bx bxs-user'></i>
                                Profile</a></li>
                        <li><a href="{{ route('payment.list') }}" class="dropdown-item"> <i
                                    class='bx bx-credit-card me-2'></i> Belum Bayar</a></li>
                        <li><a href="{{ route('payment.history') }}" class="dropdown-item"> <i
                                    class='bx bx-history me-2'></i> Riwayat Pesanan</a></li>

                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button class="dropdown-item" type="submit"><i class='bx bx-log-out-circle'></i>
                                Logout</button>
                        </form>
                </li>
            </ul>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="badge rounded-pill text-white"
                    style="background-color: var(--maroon1)">
                    Log in <i class='bx bx-log-in bx-flip-vertical'></i>
                </a>
            </li>
        @endauth
        </ul>
    </div>
</div>
