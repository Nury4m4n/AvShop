<div class="sidebar" id="sidebar">
    <ul class="nav-list">
        @can('admin')
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class='bx bx-tachometer'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('umrah-packages.index') }}"
                    class="{{ request()->routeIs('umrah-packages.index') ? 'active' : '' }}">
                    <i class='bx bx-package'></i>
                    <span class="links_name">Paket Umrah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('package-variants.index') }}"
                    class="{{ request()->routeIs('package-variants.index') ? 'active' : '' }}">
                    <i class='bx bx-cube'></i>
                    <span class="links_name">Varian Paket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('order') }}" class="{{ request()->routeIs('order') ? 'active' : '' }}">
                    <i class='bx bx-cart'></i>
                    <span class="links_name">Status Pesanan</span>
                </a>
            </li>


            <li>
                <a href="{{ route('testimonials.index') }}"
                    class="{{ request()->routeIs('testimonials.index') ? 'active' : '' }}">
                    <i class='bx bx-comment-dots'></i>
                    <span class="links_name">Testimoni</span>
                </a>
            </li>
            <li>
                <a href="{{ route('carousels.index') }}"
                    class="{{ request()->routeIs('carousels.index') ? 'active' : '' }}">
                    <i class='bx bx-images'></i>
                    <span class="links_name">Galeri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('teams.index') }}" class="{{ request()->routeIs('teams.index') ? 'active' : '' }}">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Tim</span>
                </a>
            </li>
            <li>
                <a href="{{ route('report.umrah-packages') }}"
                    class="{{ request()->routeIs('report.umrah-packages') ? 'active' : '' }}">
                    <i class='bx bx-chart'></i>
                    <span class="links_name">Laporan</span>
                </a>
            </li>
        @endcan
    </ul>
</div>

<style>
    .sidebar .nav-list li a.active {
        background-color: #f0f0f0;
        color: #333;
    }

    .sidebar .nav-list li a.active i {
        color: #333;
    }

    .sidebar .nav-list i {
        font-size: 24px;
        margin-right: 10px;
        transition: color 0.3s ease;
    }

    .sub-menu {
        display: none;
        padding-left: 20px;
        list-style-type: none;
        transition: display 0.3s ease;
    }

    .nav-item.open .sub-menu {
        display: block;
    }

    .nav-item>a>i.bx-chevron-down {
        float: right;
        transition: transform 0.3s ease;
    }

    .nav-item.open>a>i.bx-chevron-down {
        transform: rotate(180deg);
    }

    .sub-menu .active {
        background-color: #e9ecef;
    }

    .sub-menu a:hover {
        background-color: #f1f1f1;
    }
</style>

<script>
    document.querySelectorAll('.nav-item > a').forEach(item => {
        item.addEventListener('click', function(e) {
            const parentItem = item.parentElement;
            const subMenu = parentItem.querySelector('.sub-menu');

            // Prevent default behavior
            e.preventDefault();

            // Toggle the current sub-menu visibility
            parentItem.classList.toggle('open');
        });
    });
</script>
