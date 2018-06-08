@extends('layouts.app')

@section('content')
<form action="{{route('admin.jurusan.update', $jurusan->id_jurusan)}}" method="POST">
@csrf

<div class="container-fluid">

<div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-body">
                <h3 class="card-title">Jurusan</h3>
                <span class="card-subtitle">Edit Jurusan</span>
                <hr>

                <div class="form-group">
                    <label for="nama_jurusan">Nama jurusan</label>
                    <input type="text" name="nama_jurusan" class="form-control" value="{{$jurusan->nama_jurusan}}">
                </div>

                <div class="form-group">
                    <label for="deskripsi_jurusan">Deskripsi jurusan</label>
                    <input type="text" name="deskripsi_jurusan" class="form-control" value="{{$jurusan->deskripsi_jurusan}}">
                </div>

                <button class="btn btn-primary">Save</button>

                <br>

                <a href="{{ url()->previous() }}"><span class="fa fa-arrow-left"></span> Kembali</a>
            </div>
        </div>
    </div>

</div>

</form>
@endsection
