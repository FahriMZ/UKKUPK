@extends('layouts.app')

@section('css')

@stop

@section('content')

<a href="{{route('admin.kelas.store')}}" class="btn btn-outline-success add">Tambah Kelas</a>

<div class="container-fluid">

    <div class="card card-body">
        <div class="row">
            <div class="col card-title">
            <h3>Kelas</h3>
            @if(isset($_GET['q']) && $_GET['q'] != '')
            <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
            @endif
            </div>
            <form method="GET" action="{{ route('admin.kelas.index') }}">
                <div class="col form-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari kelas..">
                </div>
            </form>
        </div>

        @if($kelas->count() <= 0)
        <h4 class="card-subtitle">Tidak ada kelas</h4>

        @else
        <table class="table">
            <thead>
                <th>#</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Siswa</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($kelas as $key => $row)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$row->nama_kelas}}</td>
                    <td>{{$row->jurusan->nama_jurusan}}</td>
                    <td>{{$row->peserta->count()}}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{ route('admin.kelas.edit', $row->id_kelas) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                        <a href="{{ route('admin.kelas.delete', $row->id_kelas) }}" class="btn btn-danger remove {{$row->peserta->count() > 0 ? 'disabled' : ''}}"><span class="fa fa-trash"></span></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $kelas->links() }}

        @endif
    </div>
</div>
@endsection

@section('js')

@stop