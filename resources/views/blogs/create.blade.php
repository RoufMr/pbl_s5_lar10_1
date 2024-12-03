@extends('master.master-admin')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<section>
    <div>
        <div>
            <a href="{{ route('blog') }}"><i class="fas fa-arrow-left fa-2x"></i></a>
            {{-- <div class="mx-2">.</div> --}}
            {{-- <a href="">Buat Artikel</a> --}}
        </div>

        <h3 class="text-center">Halaman Buat Artikel</h3>

        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="">Masukkan Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                value="{{ old('judul') }}">

                @error('judul')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="">Masukkan Gambar</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="">Masukkan Deskripsi</label>
                <div class="bg-white">
                <textarea name="desc" id="your_summernote">
                    {{ old('desc') }}
                </textarea>
            </div>

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
