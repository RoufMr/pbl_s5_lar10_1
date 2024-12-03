@extends('master.master-admin')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<section class="py-5">
    <div class="container" col-xxl-8>
        <div class="d-flex">
            <a href="{{ route('blog') }}">Blog</a>
            <div class="mx-2">.</div>
            <a href="">Edit Artikel</a>
        </div>
        <h4>Halaman Edit Artikel</h4>

        <form action="{{ route('blog.update',$artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="">Masukkan Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                value="{{ old('judul',$artikel->judul) }}">

                @error('judul')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="">Masukkan Gambar</label>
                <input type="hidden" name="old_image" value="{{ $artikel->image }}">
                <div>
                    <img src="{{ asset('storage/artikel/' . $artikel->image) }}" alt="" class="col-lg-4">
                </div>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="">Masukkan Deskripsi</label>
                <textarea name="desc" id="your_summernote">
                    {!! $artikel->desc !!}
                </textarea>

                @error('desc')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

{{-- summernote --}}
{{-- <script>
$('#summernote').summernote({
    tabsize: 2,
    height: 100
    });
    </script> --}}

</section>
@endsection
{{-- @section('menu')
    @include('dashboard')
@endsection --}}
