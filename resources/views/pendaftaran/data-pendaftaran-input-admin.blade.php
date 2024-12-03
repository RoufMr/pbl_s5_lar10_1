@extends('master.master-admin')

@section('content')
    <div class="row">
        <form action="/save-registration" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <div class="col-xl-12">
                <div class="custom-accordion">
                    <div class="card">
                        <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                    </div>
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
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nim">NIM</label>
                                            <input type="text" class="form-control" id="personal-data-nim"
                                                name="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
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

                                            @if ( auth()->user()->profile->nama  != null)
                                                <input type="text" class="form-control" id="basicpill" name="nama"
                                                    placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->profile->nama }}" required>
                                            @else
                                                <input type="text" class="form-control" id="personal-data-name"
                                                    name="nama" placeholder="Masukkan Nama Lengkap"
                                                    value="{{ old('nama') }}" required>
                                            @endif
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

                                            @if ( auth()->user()->profile->prodi  != null)
                                                <input type="text" class="form-control" id="basicpill" name="prodi"
                                                    placeholder="Masukkan Prodi" value="{{ auth()->user()->profile->prodi }}" required>
                                            @else
                                                <input type="text" class="form-control" id="personal-data-prodi"
                                                    name="prodi" placeholder="Masukkan Prodi"
                                                    value="{{ old('prodi') }}" required>
                                            @endif
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

                                            @if ( auth()->user()->profile->alasan  != null)
                                                <input type="text" class="form-control" id="basicpill" name="alasan"
                                                    placeholder="Alasan join UKM IMAM" value="{{ auth()->user()->profile->alasan }}" required>
                                            @else
                                                <input type="text" class="form-control" id="personal-data-alasan"
                                                    name="alasan" placeholder="Alasan join UKM IMAM"
                                                    value="{{ old('alasan') }}" required>
                                            @endif
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
                                            <label class="form-label" for="personal-data-gender">Jenis
                                                Kelamin</label>
                                            @if (auth()->user()->profile->gender != null)
                                                @if (auth()->user()->profile->gender == 'Perempuan')
                                                    <select class="form-control wide" name="jk"
                                                        value="{{ old('jk') }}">
                                                        <option value="{{ auth()->user()->profile->gender }}" selected>
                                                            {{ auth()->user()->profile->gender }}</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                    </select>
                                                @else
                                                    <select class="form-control wide" name="jk"
                                                        value="{{ old('jk') }}">
                                                        <option value="{{ auth()->user()->profile->gender }}" selected>
                                                            {{ auth()->user()->profile->gender }}</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                @endif
                                            @else
                                                <select class="form-control wide" name="jk"
                                                    value="{{ old('jk') }}">
                                                    <option value="{{ old('jk') }}" disabled selected>Pilih
                                                        Jenis Kelamin </option>
                                                    <option value="Laki-laki">Laki-aki</option>
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
                                            <select class="form-control wide" name="agama"
                                                value="{{ old('agama') }}">
                                                <option value="{{ old('agama') }}" disabled selected>Pilih agama
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
                                            <label class="form-label">Tempat lahir</label>
                                            @if (auth()->user()->profile->tempat_lahir != null)
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ auth()->user()->profile->tempat_lahir }}" required>
                                            @else
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ old('tempatlahir') }}" required>
                                            @endif
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
                                            <label class="form-label" for="billing-city">Tanggal lahir</label>
                                            @if (auth()->user()->profile->tanggal_lahir != null)
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ auth()->user()->profile->tanggal_lahir }}" required>
                                            @else
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ old('tanggallahir') }}" required>
                                            @endif
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
                                            <label class="form-label" for="zip-code">Pas Photo</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="foto" value="{{ old('foto') }}" accept="image/png, image/jpg, image/jpeg" required>
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
                                                    <input type="file" class="form-file-input form-control"
                                                        name="CV" value="{{ old('CV') }}" accept="image/png, image/jpg, image/jpeg" required>
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
                                            <label class="form-label" for="zip-code">Bukti Subscribe Youtube</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="bukti_yt" value="{{ old('bukti_yt') }}" accept="image/png, image/jpg, image/jpeg" required>
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
                                                    <input type="file" class="form-file-input form-control"
                                                        name="bukti_ig" value="{{ old('bukti_ig') }}" accept="image/png, image/jpg, image/jpeg" required>
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

                                    @if (auth()->user()->profile->alamat != null)
                                        <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                            placeholder="Masukkan alamat lengkap">{{ auth()->user()->profile->alamat }}</textarea>
                                    @else
                                        <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                            placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @endif
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
                                            <input type="email" class="form-control" id="personal-data-nim"
                                                name="email" placeholder="Masukkan email"
                                                value="{{ auth()->user()->email }}" required readonly>
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
                                            <label class="form-label" for="personal-data-nim">No
                                                Hp/WhatsApp</label>
                                            @if (auth()->user()->profile->no_hp != null)
                                                <input type="number" class="form-control" id="basicpill" name="nohp"
                                                    placeholder="Masukkan Tanggal Lahir" value="{{ auth()->user()->profile->no_hp }}" required>
                                            @else
                                                <input type="number" class="form-control" id="basicpill" name="nohp"
                                                    placeholder="Masukkan nomor telepon" value="{{ old('nohp') }}" required>
                                            @endif
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
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                    </div>
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
                                    <select class="form-control wide" name="gelombang" required>
                                        @foreach ($viewDataJadwal as $x)
                                            <option value="{{ $x->id }}" selected>{{ $x->nama_kegiatan }}
                                            </option>
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
                                            <label class="form-label" for="personal-data-nim">Pilihan
                                                1</label>
                                            <input class="form-control" list="datalistOptionsDivisi" id="exampleDataList"
                                                placeholder="Pilih divisi" name="pil1"
                                                value="{{ old('pil1') }}" required>
                                            <datalist id="datalistOptionsDivisi">
                                                @foreach ($viewDivisi as $z)
                                                    <option value="{{ $z->id }}">{{ $z->nama_divisi }}
                                                    </option>
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
                                            <input class="form-control" list="datalistOptionsDivisi" id="exampleDataList"
                                                placeholder="Pilih Divisi" name="pil2"
                                                value="{{ old('pil2') }}" required>
                                            <datalist id="datalistOptionsDivisi">
                                                @foreach ($viewDivisi as $z)
                                                    <option value="{{ $z->id }}">{{ $z->nama_divisi }}
                                                    </option>
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
                                <button type="submit" name="add" class="btn btn-primary">Buat Pendaftaran</button>
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

{{-- @section('footer')
@endsection --}}
@section('menu')
    @include('dashboard')
@endsection
