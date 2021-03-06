@extends('layouts.app')

@section('content')
<form action="{{route('admin.perusahaan.store')}}" method="POST">
@csrf

<div class="container-fluid">

<div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-body">
                <h3 class="card-title">Perusahaan</h3>
                <span class="card-subtitle">Tambah baru</span>
                <hr>

                <div class="form-group">
                    <label for="nama_perusahaan">Nama perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alamat_perusahaan">Alamat perusahaan</label>
                    <textarea name="alamat_perusahaan" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="direktur_perusahaan">Direktur perusahaan</label>
                    <input type="text" name="direktur_perusahaan" class="form-control">
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tipe_perusahaan" {{ old('tipe_perusahaan') ? 'checked' : '' }}> {{ __('Atur sebagai internal') }}
                        </label>
                    </div>
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
