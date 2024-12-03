@extends('master.master-admin')
{{-- @section('title', 'Dashboard') --}}
@section('title')
    Imam Poliwangi
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection


@section('menunya')
    Data Artikel
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pendaftar</h4>

                <!-- center modal -->
                <div>
                    {{-- <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i class="fa fa-print"> </i></button> --}}
                    <a href="{{ route("blog.create") }}" type="bottom" class="btn btn-primary btn-sm ml-auto">
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
                                <th>Image</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                                <th>Status Upload</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($artikels as $artikel)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img src="{{ asset('storage/artikel/' . $artikel->image) }}" height="100" alt="">
                                </td>
                                <td>
                                    {{ $artikel->judul }}
                                </td>
                                <td>
                                    <a href="{{ route('blog.edit',$artikel->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('blog.destroy', $artikel->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                <td>
                                    <input type="checkbox" class="toggle-status" data-id="{{ $artikel->id }}"
                                        {{ $artikel->status ? 'checked' : '' }} data-toggle="toggle">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- /.container-fluid -->
@include('sweetalert::alert')

@endsection

@section('footer')
@endsection
