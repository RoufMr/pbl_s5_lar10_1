@extends('master.master-admin')
@section('title')
    Imam Poliwangi
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection


@section('menunya')
    Video IMAM
@endsection

@section('menu')
    @auth
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

    @endauth
@endsection


@section('content')
{{-- @section('title', 'Dashboard') --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pendaftar</h4>

                <!-- center modal -->
                <div>
                    {{-- <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i class="fa fa-print"> </i></button> --}}
                    <a href="" class="btn btn-primary btn-sm ml-auto" data-bs-toggle="modal" data-bs-target="#tambahVideo">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </a>
                </div>
            </div>
            <div class="card-body" id="cetak">
                <div class="table-responsive">
                    {{-- {{ csrf_field() }} --}}

                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Judul</th>
                                <th>Video</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($videos as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>

                                    <td>{{ $item->judul }}</td>

                                    <td>
                                        <iframe height="150"
                                        src="https://www.youtube.com/embed/{{ $item->yt_code }}"
                                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editVideo{{ $item->id }}">Edit</a>
                                        <form action="{{ route('video.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal edit -->
                                <div class="modal fade" id="editVideo{{ $item->id }}" tabindex="-1" aria-labelledby="editVideoLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editVideoLabel{{ $item->id }}">Modal Edit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Menampilkan pesan kesalahan jika ada -->
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <form action="{{ route('video.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_video" value="{{ $item->id }}">

                                                    <div class="form-group mb-3">
                                                        <label for="">Judul</label>
                                                        <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="">Youtube Code</label>
                                                        <input type="text" name="yt_code" class="form-control" value="{{ $item->yt_code }}" required>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal upload -->
    <div class="modal fade" id="tambahVideo" tabindex="-1" aria-labelledby="tambahVideoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahVideoLabel">Modal Video</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Menampilkan pesan kesalahan jika ada -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('video.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Judul</label>
                            <input type="text" name="judul" class="form-control" >
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Youtube Code</label>
                            <input type="text" name="yt_code" class="form-control" >
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
@section('footer')
@endsection
