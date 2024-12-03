<ul class="metismenu" id="menu">
    <li class="mm-active"><a href="dashboard">
            <i class="fas fa-home"></i>
            <span class="nav-text">Beranda</span>
        </a>
    </li>

    {{-- NAVBAR ADMIN --}}
    @if (auth()->user()->role == 'Administrator')
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-book"></i>
                <span class="nav-text">Data Master </span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{route('data-user')}}">Pengguna</a></li>
                <li><a href="{{route('data-divisi')}}">Divisi</a></li>
                <li><a href="{{route('data-jadwal')}}">Jadwal Kegiatan</a></li>
            </ul>
        </li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-database"></i>
                <span class="nav-text">Data Transaksi</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{route('data-registration')}}">Pendaftaran</a></li>
                <li><a href="{{route('data-pembayaran')}}">Pembayaran</a></li>
            </ul>
        </li>

        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-database"></i>
            <span class="nav-text">Data Postingan</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{route('blog')}}">Artikel</a></li>
            <li><a href="{{route('photo')}}">Photo</a></li>
            <li><a href="{{route('video')}}">Video</a></li>
        </ul>
    </li>

        <li>
            <a href="{{route('data-pengumuman')}}" aria-expanded="false">
                <i class="fa fa-file"></i>
                <span class="nav-text">Pengumuman</span>
            </a>
        </li>

    @else

    {{-- NAVBAR USER --}}
        <li><a href="{{route('data-registration')}}" aria-expanded="false">
            <i class="fa fa-database"></i>
                <span class="nav-text">Pendaftaran</span>
            </a>
        </li>
    @endif
</ul>
