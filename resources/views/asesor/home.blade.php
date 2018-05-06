@extends('layouts.app')

@section('css')
<style type="text/css">
    .card:hover {
        background-color: #4598DB;
        cursor: pointer;
        color: white;
    }

    .card {
        height: 500px;
        padding-top: 100px;
    }
</style>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col mb-3 menu" data-url="{{route('asesor.data-asesor.edit')}}">
            <div class="card">

                <div class="card-body" style="text-align: center">
                    
                    <span class="fa fa-user text-success mb-3" style="font-size: 155px;"></span>
                    <h3>Data Asesor</h3>

                </div>

            </div>
        </div>

        <div class="col mb-3 menu" data-url="{{route('asesor.dokumen-asesor.index')}}">
            <div class="card">

                <div class="card-body" style="text-align: center">
                    
                    <span class="fa fa-file text-warning mb-3" style="font-size: 155px;"></span>
                    <h3>Dokumen Asesor</h3>

                </div>

            </div>
        </div>

        <div class="col mb-3 menu" data-url="{{route('asesor.penilaian.index')}}">
            <div class="card">

                <div class="card-body" style="text-align: center">
                    
                    <span class="fa fa-list text-danger mb-3" style="font-size: 155px;"></span>
                    <h3>Penilaian Peserta</h3>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
    $('.menu').click(function() {
        var url = $(this).data('url');
        window.location.replace(url);
    });
</script>

@stop