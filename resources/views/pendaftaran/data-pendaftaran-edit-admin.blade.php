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
    Data Pendaftaran
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
        <form action="/update-registration/{{ $viewData->id_pendaftaran }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-xl-12">
                <div class="custom-accordion">
                    <div class="card">
                        <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i> </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Pribadi</h5>
                                        <p class="text-muted text-truncate mb-0">NIM, Nama, Prodi, Jenis Kelamin, Pas
                                            Photo, TTL, dsb</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="personal-data" class="collapse show">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label"  for="personal-data-nim">NIM</label>
                                            <input type="text" value="{{ $viewData->nim }}" class="form-control" id="personal-data-nim" name="nim"
                                                placeholder="Enter NIM" value="{{ old('nim') }}">
                                            @error('nim')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Nama</label>
                                            <input type="text" value="{{ $viewData->nama_siswa }}" class="form-control" id="personal-data-name" name="nama"
                                                placeholder="Enter Name" value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-prodi">Prodi</label>
                                            <input type="text" value="{{ $viewData->prodi }}" class="form-control" id="personal-data-prodi" name="prodi"
                                                placeholder="Enter Prodi" value="{{ old('prodi') }}">
                                            @error('prodi')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-alasan">Alasan</label>
                                            <input type="text" value="{{ $viewData->alasan }}" class="form-control" id="personal-data-alasan" name="alasan"
                                                placeholder="Enter Alasan" value="{{ old('alasan') }}">
                                            @error('alasan')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Jenis Kelamin</label>
                                            @if ($viewData->jenis_kelamin == 'Perempuan')
                                                <select class="form-control wide" name="jk" value="{{ old('jk') }}">
                                                    <option value="{{ $viewData->jenis_kelamin }}" selected> {{ $viewData->jenis_kelamin }}</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                </select>
                                            @else
                                                <select class="form-control wide" name="jk" value="{{ old('jk') }}">
                                                    <option value="{{ $viewData->jenis_kelamin }}" selected> {{ $viewData->jenis_kelamin }}</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            @endif
                                            @error('jk')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">Agama</label>
                                            <select class="form-control wide" name="agama" value="{{ old('agama') }}">
                                                <option value="{{ old('agama') }}"  selected>{{ $viewData->agama }}
                                                </option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Kong Hu Chu ">Kong Hu Chu</option>
                                                <option value="Lainnya">Etc</option>
                                            </select>
                                            @error('agama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" value="{{ $viewData->tempat_lahir }}" class="form-control" id="basicpill" name="tempatlahir"
                                                placeholder="Masukkan Tempat Lahir" value="{{ old('tempatlahir') }}">
                                            @error('tempatlahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label" for="billing-city">Tanggal Lahir</label>
                                            <input type="date" value="{{ $viewData->tanggal_lahir }}" class="form-control" id="basicpill" name="tanggallahir"
                                            placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggallahir') }}">
                                            @error('tanggallahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!--<input name="tanggallahir" class="datepicker-default form-control" id="datepicker" >-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">Pas Foto</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control" name="foto"
                                                        value="{{ old('foto') }}">
                                                    <input type="hidden" name="pathFoto" class="form-control-file"
                                                        value="{{ $viewData->foto }}">
                                                </div>
                                            </div>
                                            @error('foto')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">CV</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control" name="CV"
                                                        value="{{ old('CV') }}">
                                                    <input type="hidden" name="pathFotoCV" class="form-control-file"
                                                        value="{{ $viewData->CV }}">
                                                </div>
                                            </div>
                                            @error('CV')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">Bukti Follow YouTube</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control" name="bukti_yt"
                                                        value="{{ old('bukti_yt') }}">
                                                    <input type="hidden" name="pathFotoYT" class="form-control-file"
                                                        value="{{ $viewData->bukti_yt }}">
                                                </div>
                                            </div>
                                            @error('bukti_yt')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">Bukti Follow Instagram</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control" name="bukti_ig"
                                                        value="{{ old('bukti_ig') }}">
                                                    <input type="hidden" name="pathFotoIG" class="form-control-file"
                                                        value="{{ $viewData->bukti_ig }}">
                                                </div>
                                            </div>
                                            @error('bukti_ig')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="billing-address">Alamat</label>
                                    <textarea class="form-control" id="billing-address" rows="3" name="alamat"
                                        placeholder="Masukkan Alamat">{{ $viewData->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nim">Email</label>
                                            <input type="email" value="{{ $viewData->email }}" class="form-control" id="personal-data-nim" name="email"
                                                placeholder="Masukkan email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nim">Mobile
                                                Nomor Telepon/WhatsApp</label>
                                            <input type="number" value="{{ $viewData->hp }}" class="form-control" id="personal-data-nim" name="nohp"
                                                placeholder="Masukkan No HP" value="{{ old('nohp') }}">
                                            @error('nohp')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#registration-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i> </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Pendaftaran</h5>
                                        <p class="text-muted text-truncate mb-0">Pilihan Divisi </p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="registration-data" class="collapse">
                            <div class="p-4 border-top">
                                <div class="mb-4">
                                    <label class="form-label" for="billing-address">Gelombang</label>
                                    <select class="form-control wide" name="gelombang">
                                        <option value="{{ $viewData->gelombang }}" selected>{{ $viewData->jadwal->nama_kegiatan }}</option>
                                        @foreach ($viewDataJadwal as $x)

                                        <option value="{{$x->id}}">{{$x->nama_kegiatan}}</option>
                                        @endforeach
                                        </select>
                                    @error('gelombang')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nim">Pilihan 1</label>
                                            <input class="form-control" value="{{ $viewData->pil1 }}" list="datalistOptionsDivisi" id="exampleDataList"
                                                placeholder="Cari Divisi..." name="pil1" value="{{ old('pil1') }}" autocomplete='off' >
                                            <datalist id="datalistOptionsDivisi">
                                                @foreach ($viewDivisi as $z)
                                                    <option value="{{ $z->id_divisi }}">{{ $z->nama_divisi }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('pil1')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nim">Pilihan 2</label>
                                            <input class="form-control" value="{{ $viewData->pil2 }}" list="datalistOptionsDivisi" id="exampleDataList"
                                                placeholder="Type to search..." name="pil2" value="{{ old('pil2') }}" autocomplete='off' >
                                            <datalist id="datalistOptionsDivisi">
                                                @foreach ($viewDivisi as $z)
                                                    <option value="{{ $z->id_divisi }}">{{ $z->nama_divisi }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('pil2')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <button type="submit" name="add" class="btn btn-primary">Perbaharui</button>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row-->
                </div>
        </form>
    </div>
    <!-- end row -->
@endsection

@section('footer')
@endsection
{{-- @section('menu')
    @include('dashboard')
@endsection --}}
