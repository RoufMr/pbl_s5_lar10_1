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
    Beranda
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
    <!--ADMIN-->
    <div class="row">
        <div class="col-xl-12">
            <div class="text-end mt-2 mt-sm-0">
                <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                    class="fa fa-print"> </i></button>
            </div>
            <div class="card"  id="cetak">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mb-3">
                            <h4 class="fs-24 font-w700">Pengumuman <br>Pendaftaran Mahasiswa Baru</h4>
                            <span>didaftarkan oleh <strong>{{ auth()->user()->name }}</strong> pada
                                {{ $viewIdPendaftaran->tgl_pendaftaran }}</span>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-4 pb-3 justify-content-end flex-wrap">
                                <div class="me-3">
                                    <h4 class="fs-18 font-w600">PMB PEI</h4>
                                    <span>Kembangkuning, Ubrug, Jatiluhur <br>Purwakarta 41152 Indonesia</span>
                                </div>
                                <div class="me-3">
                                    <img src="{{ asset('sipenmaru/images/logo.png') }}" alt="" width="50px">
                                </div>
                                <!--
                                        <div>
                                            <div class="dropdown">
                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5"></circle>
                                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5"></circle>
                                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5"></circle>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0)">Unduh Hasil Pendaftaran</a>
                                                </div>
                                                DAFTAR DONLOT
                                            </div>
                                        </div>-->

                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                        <div class="p-4 border-top">
                            <table class="table mb-0">

                                <thead class="table-light col-lg-12">
                                    <tr>
                                        <td colspan="2">Data Siswa Pendaftar</td>
                                    </tr>
                                </thead>
                                <tbody border="5">

                                    <tr border="5">
                                        <td scope="row" width="70%">
                                            <table>
                                                <tr border="5">
                                                    <th scope="row" width="50%">No Pendafataran</th>
                                                    <td  width="50%">{{ $viewIdPendaftaran->id_pendaftaran }}</td>
                                                <tr>
                                                <tr border="5">
                                                    <th scope="row"  width="50%">NIM Siswa</th>
                                                    <td width="50%">{{ $viewIdPendaftaran->nim }}</td>
                                                </tr>
                                                <tr border="5">
                                                    <th scope="row"  width="50%">Nama Siswa</th>
                                                    <td  width="50%">{{ $viewIdPendaftaran->nama_siswa }}</td>
                                                </tr>
                                                <tr border="5">
                                                    <th scope="row"  width="50%">Prodi</th>
                                                    <td  width="50%">{{ $viewIdPendaftaran->nama_prodi }}</td>
                                                </tr>

                                            </table>
                                        </td>
                                        <td colspan="4"><img src="{{ url('/'.$viewIdPendaftaran->pas_foto) }}" alt="" width="180px" height="240"></td>
                                    <tr>

                                    <tr border="5">
                                        <th colspan="3" scope="row">
                                            <br>
                                            @foreach ($viewData as $x)
                                                    @if($x->hasil_seleksi == 'TIDAK LULUS' && $x->id_pendaftaran== $viewIdPendaftaran->id)
                                                    <div class="alert alert-danger solid alert-rounded" style="border-radius: 0%">
                                                        <strong>Semangat!</strong> Anda TIDAK LULUS seleksi Penerimaan
                                                        Mahasiswa Baru, Silahkan coba kembali, Jangan Menyerah Ya!
                                                    </div>
                                                    @elseif ($x->hasil_seleksi == 'LULUS' && $x->id_pendaftaran== $viewIdPendaftaran->id)
                                                        <div class="alert alert-success solid" style="border-radius: 0%">
                                                            <strong>Selamat!</strong> Anda dinyatakan <strong>LULUS</strong>  seleksi
                                                            Penerimaan Mahasiswa Baru
                                                        </div>
                                                        <div class="alert alert-outline-success alert-dismissible fade show" style="border-radius: 0%; margin-top:-1rem">
                                                            <table>
                                                                <tr>
                                                                    <th scope="row">Divisi Penerima <b>{{$x->divisi->nama_divisi}}</b></th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    @endif
                                        @endforeach
                                    </th>
                                </tr>
                                <tr>
                                    <td scope="row" style="margin-top:-50px"><small>* Bawa Bukti Penerimaan Saat Melakukan Daftar Ulang</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('footer')
@endsection
