@extends('layouts.app')
@section('content')

@include('asesor.dokumen-asesor.addDokumen')

<div class="container">
    
    <div class="card card-body mb-3">
        <h3 class="card-title">Asesor</h3>

        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a href="#pills-asesor" class="nav-link active" id="pills-asesor-tab" data-toggle="pill" role="tab" aria-controls="pills-asesor" aria-selected="true">Data Diri</a>
            </li>
            <li class="nav-item">
                <a href="#pills-dokumen" class="nav-link" id="pills-dokumen-tab" data-toggle="pill" role="tab" aria-controls="pills-dokumen" aria-selected="true">Dokumen</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <!-- Tambah Komponen -->

        <div class="tab-pane fade show active" id="pills-asesor" role="tab-panel" aria-labelledby="pills-asesor-tab">
            
            <div class="card card-body mb-3">
            <h4 class="card-title">
                {{ $asesor->nama }}
                <div class="float-right">
                    <a href="{{ route('admin.asesor.edit', $asesor->id_asesor) }}" class="btn btn-warning"><span class="fa fa-edit"></span> Edit</a>
                    <a href="{{ route('admin.asesor.delete', $asesor->id_asesor) }}" class="btn btn-danger remove"><span class="fa fa-trash"></span> Hapus</a>
                </div>
            </h4>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr>
                        <td>Username</td>
                        <td>{{ $asesor->user->username }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>{{ date('d M Y', strtotime($asesor->tanggal_lahir)) }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>{{ $asesor->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $asesor->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $asesor->user->email }}</td>
                    </tr>
                    <tr>
                        <td>Perusahaan</td>
                        <td>{{ $asesor->perusahaan->nama_perusahaan }}</td>
                    </tr>
                </table>
            </div>
            </div>
        </div>

        <!-- END Asesor -->

        <!-- Dokumen -->
        <div class="tab-pane fade" id="pills-dokumen" role="tab-panel" aria-labelledby="pills-dokumen-tab">
        <div class="container-fluid">
            <div class="row">
                @foreach($asesor['dokumenAsesor'] as $dokumen)
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 195px;">
                        <div class="card-body">
                        @if(str_word_count($dokumen->nama_dokumen) > 60)
                        {{ substr($dokumen->nama_dokumen, 0, 60) . "..." }}
                        @else
                        {{ $dokumen->nama_dokumen }}
                        @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{route('admin.dokumen-asesor.delete', $dokumen->id_dokumen)}}" class="btn btn-outline-danger remove">Hapus</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
        <!-- END Dokumen -->

    </div>
    

</div>
@stop

@section('js')

@stop