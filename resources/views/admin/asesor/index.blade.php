@extends('layouts.app')

@section('css')

@stop

@section('content')

<a href="{{route('admin.asesor.create')}}" class="btn btn-outline-success add">Tambah Asesor</a>

<div class="container-fluid">

<div class="card card-body">
    <div class="card-title row">
        <div class="col">
            <h3>Asesor</h3>

            @if(isset($_GET['q']) && $_GET['q'] != '')
            <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
            @endif
        </div>

        <form method="GET" action="{{ route('admin.asesor.index') }}">
            <div class="col form-group">
                <input type="text" name="q" class="form-control" placeholder="Cari asesor..">
            </div>
        </form>
    </div>

    @if($asesor->count() <= 0)
    <h3>Tidak ada asesor :)</h3>

    @else

    <table class="table table-hover">
        <thead>
            <th>#</th>
            <th>Nama</th>
            <th>Perusahaan</th>
            <th></th>
        </thead>
        <tbody>
            
            @foreach($asesor as $key => $row)
            <tr>
                <td>{{ $asesor->firstItem() + $key }}</td>
                <td>{{$row->nama}}</td>
                <td>{{ $row->perusahaan->nama_perusahaan }}</td>
                <td>
                    <a href="{{ route('admin.asesor.edit', $row->id_asesor) }}" class="btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</a>
                    <a href="{{ route('admin.asesor.show', $row->id_asesor) }}" class="btn-sm btn-info"><span class="fa fa-eye"></span> Show</a>
                    <a href="{{ route('admin.asesor.delete', $row->id_asesor) }}" class="btn-sm btn-danger remove"><span class="fa fa-trash"></span> Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{ $asesor->links() }}

    @endif
</div>


</div>
@endsection

@section('js')

@stop