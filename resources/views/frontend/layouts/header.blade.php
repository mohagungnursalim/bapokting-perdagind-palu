<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <a href="index.html"><img src="{{ asset('img/bapokting.png') }}" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}" href="/">Tabel Harga</a></li>
                <li><a class="nav-link scrollto {{ Request::is('komoditas*') ? 'active' : '' }}" href="/komoditas">Komoditas</a></li>
                <li class="dropdown"><a href="#"><span>Website</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Web Disperdagind</a></li>
                        <li><a href="#">Web Kota Palu</a></li>
                        @if (Auth::check())
                        <li><a href="/dashboard">Dashboard</a></li>
                        @else
                        <li><a href="/login">Login</a></li>
                        @endif
                        
                    </ul>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
