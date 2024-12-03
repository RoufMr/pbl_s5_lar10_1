@extends('home.layout')
@section('content')
{{-- berita --}}
{{-- <section id="berita" style="margin-top: 10px;" class="py-5">
    <div class="container py-5" >
      <div class="header-berita text-center">
        <h2 class="fw-bold">Berita Kegiatan UKM IMAM</h2>
      </div>

      <div class="row py-4" data-aos="zoom-in">
        @foreach ($artikels as $item)
        <div class="col-lg-4" data-aos="zoom-in">
            <div class="card-border-0">
              <img src="{{ asset('storage/artikel/'.$item->image) }}" class="img-fluid mb-3" alt="">
              <div class="konten-berita">
                <p class="mb-3 text-secondary">{{ $item->create_at }}</p>
                <h4 class="fw-bold mb-3">{{ $item->judul }}</h4>
                <p class="text-secondary">#UKMIMAM</p>
                <a href="/detail/{{ $item->slug }}" class="text-decoration-none text-danger">Selengkapnya</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section> --}}

<section id="berita" class="py-5">
    <div class="container py-5">
        <div class="header-berita text-center">
            <h2 class="fw-bold">Berita Kegiatan UKM IMAM</h2>
        </div>

        <div class="row py-4">
            @foreach ($artikels as $item)
            <div class="col-lg-4" data-aos="zoom-in">
                <div class="card-border-0">
                    <div class="news-image-container">
                        <img src="{{ asset('storage/artikel/'.$item->image) }}" class="img-fluid mb-3" alt="">
                    </div>
                    <div class="konten-berita">
                        <p class="mb-3 text-secondary">{{ $item->create_at }}</p>
                        <h4><a href="/detail/{{ $item->slug }}" class="text-decoration-none fw-bold mb-3 text-black">{{ $item->judul }}</a></h4>
                        <p class="text-secondary">#UKMIMAM</p>
                        <a href="/detail/{{ $item->slug }}" class="text-decoration-none text-danger">Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- berita --}}

  {{-- berita --}}
@endsection
