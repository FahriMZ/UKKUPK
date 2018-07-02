@extends('layouts.app')

@section('content')
@include('asesor.dokumen-asesor.addDokumen')

<div class="container-fluid">

    <div class="card card-body mb-3">
        <div class="row">

            <div class="col card-title">
                <h4>Dokumen Asesor</h4>

                @if(isset($_GET['q']) && $_GET['q'] != '')
                <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
                @endif
            </div>

            <form method="GET" action="{{ route('asesor.dokumen-asesor.index') }}">
                <div class="col form-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari file..">
                </div>
            </form>

        </div>
    </div>

    <div class="row">
        @foreach($dokumen_asesor as $dokumen)
        <div class="col-md-4 mb-4">
            <div class="card" style="height: 195px;">
                <div class="card-body">
                <a href="{{ Storage::url('public/dokumen_asesor/'.$dokumen->nama_dokumen) }}" target="_blank">
                @if(str_word_count($dokumen->nama_dokumen) > 60)
                {{ substr($dokumen->nama_dokumen, 0, 60) . "..." }}
                @else
                {{ $dokumen->nama_dokumen }}
                @endif
		        </a>
                </div>
                <div class="card-footer">
                    <a href="{{route('admin.dokumen-asesor.delete', $dokumen->id_dokumen)}}" class="btn btn-outline-danger remove">Hapus</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $dokumen_asesor->appends(Request::except('page'))->links() }}

</div>

@stop