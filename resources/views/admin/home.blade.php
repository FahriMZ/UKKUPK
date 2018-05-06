@extends('layouts.app')

@section('css')
<style type="text/css">
.card{
    height: 255px;
}
</style>
@stop

@section('content')
<div class="container-fluid">
    
    <div class="row">
        
        <div class="col-sm-4">
            <div class="card card-body mb-3">
                <h3>Asesor</h3>
                <p></p>
                <hr>

                <a href="{{ route('admin.asesor.index') }}">CRUD</a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-body mb-3">
                <h3 class="card-title">Tahun Ajaran</h3>
                <p class="card-subtitle text-info">Tahun Aktif : {{ $tahunAktif }}</p>
                <hr>
                <a href="{{ route('admin.tahun-ajar.index') }}">CRUD</a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-body mb-3">
                <h3>Peserta</h3>
                <p></p>
                <hr>

                <a href="{{ route('admin.peserta.index') }}">CRUD</a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-body mb-3">
                <h3>Perusahaan</h3>
                <p></p>
                <hr>

                <a href="{{ route('admin.perusahaan.index') }}">CRUD</a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-body mb-3">
                <h3>Komponen</h3>
                <p></p>
                <hr>

                <a href="{{ route('admin.komponen.index') }}">CRUD</a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-body mb-3">
                <h3>Penilaian</h3>
                <p></p>
                <hr>

                <a href="{{  route('admin.penilaian.index') }}">CRUD</a>
            </div>
        </div>

    </div>

</div>
@endsection
