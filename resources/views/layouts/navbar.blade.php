<div class="navbar">
    <div class="logo-details">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <span class="logo_name me-4">Averse Shop</span>
        <div class="menu-btn-desktop" id="menu-btn-desktop">
            <i class='bx bx-menu'></i>
        </div>
    </div>

    <div class="menu-btn" id="menu-btn">
        <i class='bx bx-menu'></i>
    </div>

    <div class="navbar-icons d-flex align-items-center">
        <!-- Ikon Keranjang -->

        <!-- Dropdown User -->
        <div class="dropdown">
            <a class="dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <img src="{{ auth()->user()->profile_photo_url ?: asset('img/favicon.png') }}"
                    alt="{{ auth()->user()->name }}" class="rounded-circle me-2"
                    style="width: 40px; height: 40px; object-fit: cover; border: 2px solid white"> --}}
                {{ auth()->user()->name }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li class="dropdown-header">{{ auth()->user()->name }}</li>
                <!--<li><a href="{{ route('user_details.index') }}" class="dropdown-item">User menu</a></li>-->
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
