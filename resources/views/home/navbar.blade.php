  <!-- Navbar -->
<nav class="navbar navbar-expand-lg  fixed-top {{ Request::segment(1) ==  'home' ? 'bg-white shadow-text text-dark' : '' }}" >
    <div class="container">
        <a class="navbar-brand">
            <a href="/">
                <img src="{{ asset('image/logo_imam_no_bg.png') }}" alt="Logo" width="90" height="60" class="d-inline-block align-text-top">
            </a>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto ">
                <li class="nav-item">
                    <a class="nav-link active shadow-text" href="/" aria-current="page">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active shadow-text" href="/">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active shadow-text" href="/">Berita</a>
                <li class="nav-item">
                    <a class="nav-link active shadow-text" href="/">Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active shadow-text" href="/">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active shadow-text" href="/">Kontak</a>
                </li>
            </ul>

        </div>
        <div>

            <a href="{{ route('login') }}">
                <button type="button" class="btn btn-success">Login</button>
            </a>

        </div>
    </div>
</nav>
