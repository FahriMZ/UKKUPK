@extends('layouts.app')

@section('content')
<form action="{{route('admin.tahun-ajar.store')}}" method="POST">
@csrf

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-body">
                <h3 class="card-title">Tahun Ajaran</h3>
                <span class="card-subtitle">Tambah tahun ajar baru</span>
                <hr>

                <div class="form-group">
                    <input type="" name="tahun_ajar" class="form-control" placeholder="ex. 2017-2018">

                    @if ($errors->has('tahun_ajar'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('tahun_ajar') }}</strong>
                        </span>
                    @endif
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
