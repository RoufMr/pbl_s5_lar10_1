@extends('master.master-admin')
{{-- @section('title', 'Dashboard') --}}
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

@section('menu')
    @include('dashboard')
@endsection
