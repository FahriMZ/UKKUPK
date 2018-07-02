@extends('layouts.app')

@section('css')
<style type="text/css">
.add {
    position: fixed;
    bottom: 35px;
    right: 35px;
    z-index: 9999999;
}
</style>
@stop

@section('content')

<a href="{{route('admin.peserta.create')}}" class="btn btn-outline-success add">Tambah Peserta</a>

<a href="{{route('admin.peserta.import')}}" class="btn btn-success add-two">Import Peserta</a>
<div class="container-fluid">

<div class="container-fluid card card-body card-title">
    <h4>Tahun Aktif : {{$tahun_aktif['tahun_ajar']}}</h4>
    @if($peserta->count() <= 0)
    <p class="card-subtitle">Tidak ada peserta</p>
    @endif
</div>

<div class="card card-body">
    <div class="row">
        <div class="col card-title">
            <h3>Peserta</h3>
            @if(isset($_GET['q']) && $_GET['q'] != '')
            <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
            @endif
        </div>
        <form method="GET" action="{{ route('admin.peserta.index') }}">
            <div class="col form-group">
                <input type="text" name="q" class="form-control" placeholder="Cari peserta..">
            </div>
        </form>
    </div>
    <table class="table table-hover">
        <thead>
            <th>#</th>
            <th>ID Peserta</th>
            <th>Nama</th>
            <th></th>
        </thead>
        <tbody>
            
            @foreach($peserta as $key => $row)
            <tr>
                <td>{{ $peserta->firstItem() + $key }}</td>
                <td>{{$row->id_peserta}}</td>
                <td>{{ $row->nama }}</td>
                <td>
                    <a href="{{ route('admin.peserta.edit', $row->id_peserta) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                    <a href="{{ route('admin.peserta.show', $row->id_peserta) }}" class="btn btn-info"><span class="fa fa-eye"></span></a>
                    <a href="{{ route('admin.peserta.delete', $row->id_peserta) }}" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{ $peserta->appends(Request::except('page'))->links() }}
</div>

</div>
@endsection

@section('js')
@stop