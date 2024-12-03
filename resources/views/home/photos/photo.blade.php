
@extends('home.layout')
@section('content')
<section id="photo" style="margin-top: 10px;" class="py-5">
    <div class="container py-5">
        <div class="header-berita text-center">
            <h2 class="fw-bold">Foto Kegiatan UKM IMAM</h2>
        </div>

        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-lg-3 col-md-6 col-1">
                    <a class="image-link" href="{{ asset('storage/photo/'. $photo->image) }}">
                        <div class="photo-image-container">
                            <img src="{{ asset('storage/photo/'. $photo->image) }}" class="img-fluid" alt="{{ $photo->judul }}">
                        </div>
                    </a>
                    <p>{{ $photo->judul }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

