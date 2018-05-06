@extends('layouts.app')

@section('content')
<form action="{{route('set-tahun-aktif')}}" method="POST">
@csrf

<div class="container-fluid">

<div class="card card-body">
    <h3 class="card-title">Tahun Aktif</h3>
    <span class="card-subtitle">Tentukan tahun ajar yang akan dikelola</span>

    <hr>


    <div class="row">
        <div class="col-12 mb-3">
            <select class="form-control" name="id_tahun_ajar">
                @foreach($tahunAjar as $tahun)
                <option value="{{$tahun->id_tahun_ajar}}" {{$tahun->id_tahun_ajar == $tahunAktif->id_tahun_ajar ? 'selected' : '' }} >{{$tahun->tahun_ajar}}</option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <button class="btn btn-primary"><span class="fa fa-save"></span> Save</button>
            <a href="{{route('admin.tahun-ajar.create')}}" class="btn btn-outline-success float-right"><span class="fa fa-plus"></span> Tahun ajar baru</a>
        </div>
    </div>
</div>

</div>

</form>
@endsection
