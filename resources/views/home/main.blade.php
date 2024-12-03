@extends('home.layout')

@section('content')
{{-- hero --}}
<section id="hero">
    <div class="container text-white text-center">
        <div class="hero-title" data-aos="fade-up">
        <div class="hero-text">Selamat Datang <br>Website UKM IMAM</div>
        <h4>Unit Kegiatan Mahasiswa Ikatan Mahasiswa Muslim Politeknik Negeri Banyuwangi</h4>
    </div>
</div>
  </section>

  <section id="program" style="margin-top: -40px">
    <div class="container col-xxl-9">
        <div class="row">
            <div class="col-lg-3 col-md-6 col mb-2" data-aos="fade-right">
                <div class="bg-white rounded-3 shadow p-3 d-flex align-items-center">
                    <div>
                        <p>Pendidian<br>Berkualitas</p>
                    </div>
                    <img src="{{ asset('image/ic-book.png') }}" height="55" width="55" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col mb-2" data-aos="fade-right">
                <div class="bg-white rounded-3 shadow p-3 d-flex align-items-center">
                    <div>
                        <p>Pendidian<br>Berkualitas</p>
                    </div>
                    <img src="{{ asset('image/ic-globe.png') }}" height="55" width="55" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col mb-2" data-aos="fade-left">
                <div class="bg-white rounded-3 shadow p-3 d-flex align-items-center">
                    <div>
                        <p>Pendidian<br>Berkualitas</p>
                    </div>
                    <img src="{{ asset('image/ic-komputer.png') }}" height="55" width="55" alt="">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col mb-2" data-aos="fade-left">
                <div class="bg-white rounded-3 shadow p-3 d-flex align-items-center">
                    <div>
                        <p>Pendidian<br>Berkualitas</p>
                    </div>
                    <img src="{{ asset('image/ic-neraca.png') }}" height="55" width="55" alt="">
                </div>
            </div>
        </div>
    </div>
  </section>
  {{-- hero --}}

  {{-- berita --}}
  {{-- <section id="berita" class="py-5">
    <div class="container py-5" >
      <div class="header-berita text-center">
        <h2 class="fw-bold">Berita Kegiatan UKM IMAM</h2>
      </div>

      <div class="row py-4" >
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

      <div class="footer-berita text-center" data-aos="zoom-in">
        <a href="/berita" class="btn btn-outline-success">Berita Lainya</a>
      </div>
    </div>
  </section> --}}

<section id="berita" class="py-5">
    <div class="container py-4">
        <div class="header-berita text-center">
            <h2 class="fw-bold">Berita Kegiatan UKM IMAM</h2>
        </div>

        <div class="row py-3">
            @foreach ($artikels as $item)
            <div class="col-lg-4" data-aos="zoom-in">
                <div class="card-border-0">
                    <div class="news-image-container">
                        <img src="{{ asset('storage/artikel/'.$item->image) }}" class="img-fluid mb-3" alt="">
                    </div>
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

        <div class="footer-berita text-center mt-2" data-aos="zoom-in">
            <a href="/berita" class="btn btn-outline-success">Berita Lainya</a>
        </div>
    </div>
</section>
{{-- berita --}}

  {{-- berita --}}

  {{-- join --}}
  <section id="join" class="py-0">
    <div class=" container py-0" >
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="zoom-in">
                <div class="d-flex align-items-center mb-3">
                    <div class="stripe me-2"></div>
                    <h5>Daftar Anggota</h5>
                </div>
                <h1 class="fw-bold mb-2">Gabung Bersama Kami, Mewujudakn Generasi Rabbani </h1>
                <p class="mb-3">UKM IMAM Poliwangi adalah Unit Kegiatan Mahasiswa yang berfokus pada aspek spiritual dan keagamaan di Politeknik Negeri Banyuwangi (Poliwangi).
                    UKM ini bertujuan untuk membina dan memperkuat iman serta meningkatkan pemahaman dan praktik keagamaan di kalangan mahasiswa.
                </p>
                <a href="{{ route('register') }}" class="btn btn-outline-success">Daftar Sekarang</a>
                {{-- <button class="btn btn-outline-success">Register</button> --}}
            </div>
            <div  class="col-lg-6" data-aos="zoom-in">
                <img src="{{ asset('image/il-Group 1.png') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
  </section>
  {{-- join --}}

  {{-- video --}}
  <section id="video" class="py-5" >
    <div class="container py-5">
        <div class="text-center" data-aos="zoom-in">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/SNSCvaQ8RuA?si=x5Iu2Dk4satSBRR0"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen></iframe>
        </div>
    </div>
  </section>

  <section id="video_yt" class="py-5" >
    <div class="container" class="py-5">
        <div class="header-berita text-center">
          <h2 class="fw-bold">Video Kegiatan UKM IMAM</h2>
          </div>

          <div class="row py-5" >

            @foreach ($videos as $item)
            <div class="col-lg-4"data-aos="zoom-in">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/{{ $item->yt_code }}"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen></iframe>
            </div>
            @endforeach

          </div>

          <div class="footer-berita text-center">
            <a href="https://youtube.com/@imampoliwangi586?si=i81H91aD2o-evFtI" class="btn btn-outline-success">Video Lainya</a>
          </div>
    </div>
  </section>
  {{-- video --}}

  {{-- foto --}}
<section id="foto" class="section-foto parallax" data-aos="zoom-in">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex align-items-center">
                <div class="stripe-putih me-2"></div>
                <h5 class="fw-bold text-white">Foto Kegiatan</h5>
            </div>
            <div>
                <a href="/photo_kegiatan" class="btn btn-outline-light">Foto Lainnya</a>
            </div>
        </div>

        <!-- Carousel Section -->
        <div class="container justify-content-center align-items-center posi-section">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-lg-3 col-md-6 col-6">
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
            </div>
        </div>
    </div>
</section>

  {{-- foto --}}

  {{-- about --}}
  <section data-aos="zoom-in">
    <div id="About" class="container-fluid mt-1" >
        <div class="row mt-5">
            <div class="col mt-5">
                <div class="p-3 box1" >
                    <div class="col-12 info-tagline" >
                        <div class="rectangle"></div>
                        <h2 data-aos="zoom-in">About</h2>
                    </div>
                    <div class="col-md-10 mt-5 mx-auto" >
                        <div class="card" data-aos="zoom-in">
                            <div class="card-body">
                                <p> Tujuan dari aplikasi ini nantinya adalah mempermudah mitra,
                                    para mahasiswa yang nantinya akan mendaftar menjadi anggota ukm dan mahasiswa yang ingin
                                    mengetahui informasi tentang ukm dan mungkin akan tertarik untuk bergabung,
                                    dan para anggota ukm yang akan meminjam alat olahraga yang akan digunakan untuk
                                    keperluan latihan.</p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
  {{-- about --}}


{{-- team --}}
{{-- <section>
    <div id="Team" class="container-fluid" data-aos="zoom-in">
        <div class="row">
            <div class="col mt-5">
                <div class="p-3 box1">
                    <div class="col-12 info-tagline">
                        <div class="rectangle"></div>
                        <h2 data-aos="zoom-in">Team</h2>
                    </div>


                    <div class="row mt-2 justify-content-center" style="position: relative; top:50px;" data-aos="zoom-in">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('image/IMG_20231220_082333.jpg') }}" class="rounded-circle" style="width: 150px; " alt="...">
                                <h5>Muhamad Cahya Yunizar </h5>
                                <p>Scrum Master</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('image/IMG-20210808-WA0110.jpg') }}" class="rounded-circle" style="width: 150px;" alt="...">
                                <h5>M. Alvian Ari Nugroho</h5>
                                <p>Web Development</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('image/IMG-20231007-WA0025.jpg') }}" class="rounded-circle" style="width: 150px;" alt="...">
                                <h5>Lisa Ayu Anjani</h5>
                                <p>Databasae Analyst</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('image/1685946468058.jpg') }}" class="rounded-circle" style="width: 150px;" alt="...">
                                <h5>Moh. Kosim</h5>
                                <p>Desain UI/UX</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('image/DSC_0093.jpg') }}" class="rounded-circle" style="width: 150px;" alt="...">
                                <h5>M. Rouf Mubarok</h5>
                                <p>Mobile Development</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- team --}}

{{-- kontak --}}
<section>
    <div id="Contact" class="container-fluid" data-aos="zoom-in">
        <div class="row">
            <div class="col mt-5">
                <div class="p-3 box1">
                    <div class="col-12 info-tagline">
                        <div class="rectangle"></div>
                        <h2 data-aos="zoom-in">Contact</h2>
                    </div>

                    <div class="row" data-aos="zoom-in">

                        {{-- <!-- Information/Preview Section -->  --}}
                        <div class="col-md-10 mt-5 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <p>Selamat datang di halaman Contact Us! Kami senang mendengar dari Anda. Jika Anda memiliki pertanyaan, saran, atau ingin berbagi pengalaman, jangan ragu untuk menghubungi tim kami. Kami berkomitmen untuk memberikan layanan terbaik dan merespons secepat mungkin.</p>
                                    <div class="contact-links">
                                        <!-- WhatsApp Logo -->
                                        <a class="contact-link" href="https://wa.me/1234567890" target="_blank">
                                            <img src="{{ asset('image/WhatsApp.png') }}" alt="WhatsApp">
                                            <h5>Call : 081 xxxx xxx</h5>
                                        </a>

                                        <!-- Instagram Logo -->
                                        <a class="contact-link" href="https://www.instagram.com/imam_poliwangi?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                                            <img src="{{ asset('image/Instagram_logo_2022.svg.png') }}" alt="Instagram" style="height: 30px; width: 30px;">
                                            <h5>imam_poliwangi</h5>
                                        </a>

                                        <!-- Gmail Logo -->
                                        <a class="contact-link" href="https://www.yourwebsite.com" target="_blank">
                                            <img src="{{ asset('image/Gmail.png') }}" alt="Gmail" style="height: 40px; width: 50px;">
                                            <h5>ukmimampoliwangi@gmail.com</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
{{-- kontak --}}

@endsection
