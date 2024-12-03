@extends('home.layout')
@section('content')
<section id="detail" style="margin-top: 70px" class="py-5">
    <div class="container col-xxl-8">
        <div class="d-flex mb-3">
            <a class="text-dark" href="/">Home</a> /
            <a class="text-dark" href="/berita">Berita</a> /
            <a class="text-dark" href="">Selengkapnya</a>
        </div>
        <!-- Menampilkan judul terlebih dahulu -->
        <div class="konten-berita">
            <h4 class="fw-bold mb-3">{{ $artikel->judul }}</h4>
            <p class="mb-3 text-secondary">{{ $artikel->created_at->format('d M Y') }}</p>
        </div>
        <!-- Kemudian menampilkan gambar setelah judul -->
        <img src="{{ asset('storage/artikel/'.$artikel->image) }}" class="img-fluid mb-3 d-block mx-auto" alt="">

        <div class="konten-berita">
            <p class="text-secondary">{!! $artikel->desc !!}</p>

        </div>
    </div>
</section>
@endsection
