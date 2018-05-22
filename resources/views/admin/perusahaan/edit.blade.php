@extends('layouts.app')

@section('content')
<form action="{{route('admin.perusahaan.update', $perusahaan->id_perusahaan)}}" method="POST">
@csrf

<div class="container-fluid">

<div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-body">
                <h3 class="card-title">Perusahaan | {{$perusahaan->nama_perusahaan}}</h3>
                <a href="{{ url()->previous() }}"><span class="fa fa-arrow-left"></span> Kembali</a>
                <hr>

                <div class="form-group">
                    <label for="nama_perusahaan">Nama perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="{{$perusahaan->nama_perusahaan}}">
                </div>

                <div class="form-group">
                    <label for="alamat_perusahaan">Alamat perusahaan</label>
                    <textarea name="alamat_perusahaan" class="form-control">{{$perusahaan->alamat_perusahaan}}</textarea>
                </div>

                <div class="form-group">
                    <label for="direktur_perusahaan">Direktur perusahaan</label>
                    <input type="text" name="direktur_perusahaan" class="form-control" value="{{$perusahaan->direktur_perusahaan}}">
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tipe_perusahaan" {{ $perusahaan->tipe_perusahaan == 'internal' ? 'checked' : '' }}> {{ __('Atur sebagai internal') }}
                        </label>
                    </div>
                </div>

                <button class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

</div>

</form>
@endsection
