@extends('layouts.app')

@section('css')

@stop

@section('content')

<a href="{{route('admin.perusahaan.create')}}" class="btn btn-outline-success add">Tambah Perusahaan</a>

<div class="container-fluid">

    <div class="card card-body">
        <div class="row">
            <div class="col card-title">
            <h3>Perusahaan</h3>
            @if(isset($_GET['q']) && $_GET['q'] != '')
            <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
            @endif
            </div>
            <form method="GET" action="{{ route('admin.perusahaan.index') }}">
                <div class="col form-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari perusahaan..">
                </div>
            </form>
        </div>

        @if($perusahaan->count() <= 0)
        <h4 class="card-subtitle">Tidak ada perusahaan</h4>

        @else
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Direktur</th>
                <th>Asesor</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($perusahaan as $key => $row)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$row->nama_perusahaan}}</td>
                    <td>{{$row->alamat_perusahaan}}</td>
                    <td>{{$row->direktur_perusahaan}}</td>
                    <td>{{$row->asesor->count()}}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{ route('admin.perusahaan.edit', $row->id_perusahaan) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                        <a href="{{ route('admin.perusahaan.delete', $row->id_perusahaan) }}" class="btn btn-danger remove {{$row->asesor->count() > 0 ? 'disabled' : ''}}"><span class="fa fa-trash"></span></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $perusahaan->appends(Request::except('page'))->links() }}

        @endif
    </div>
</div>
@endsection

@section('js')

@stop