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
    Foto IMAM
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
                    <a href="" class="btn btn-primary btn-sm ml-auto" data-bs-toggle="modal" data-bs-target="#uploadModal">
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
                                <th>Kegiatan</th>
                                <th>Aksi</th>
                                <th>Status Upload</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($photos as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <img src="{{ asset('/storage/photo/' . $item->image) }}" height="150" alt="">
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</a>
                                        <form action="{{ route('photo.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="toggle-status" data-id="{{ $item->id }}"
                                            {{ $item->status ? 'checked' : '' }} data-toggle="toggle">
                                    </td>

                                </tr>
                                <!-- Modal edit -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Modal Edit</h1>
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
                                                <form action="{{ route('photo.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id_photo" value="{{ $item->id }}">
                                                    <div class="form-group mb-3">
                                                        <label for="">Pilih Photo</label>
                                                        <div class="col-lg-4">
                                                            <img src="{{ asset('storage/photo/' . $item->image) }}" height="150" alt="">
                                                        </div>
                                                        <input type="hidden" name="old_image" value="{{ $item->image }}">
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">Nama Kegiatan</label>
                                                        <input type="text" name="judul" class="form-control" value="{{ $item->judul }}" required>
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
</div>
    <!-- Modal upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="uploadModalLabel">Modal Upload</h1>
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
                    <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Pilih Photo</label>
                            <input type="file" name="image" class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Nama Kegiatan</label>
                            <input type="text" name="judul" class="form-control" >
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

@endsection
{{-- @section('scripts')
<script>
    $(document).on('change', '.toggle-status', function () {
        var id = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('photo.updateStatus') }}",  // Pastikan membuat route ini untuk update status foto
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                status: status
            },
            success: function(response) {
                alert('Status foto berhasil diubah');
            }
        });
    });
</script>


@endsection --}}
@section('footer')
@endsection
