@extends('layouts.app')

@section('css')

@stop

@section('content')

<a href="{{route('admin.jurusan.store')}}" class="btn btn-outline-success add">Tambah Jurusan</a>

<div class="container-fluid">

    <div class="card card-body">
        <div class="row">
            <div class="col card-title">
            <h3>Jurusan</h3>

            <p>Jurusan aktif :
                <span class="text-info text-uppercase">{{ $jurusanAktif->jurusan->nama_jurusan }}</span>
                <button class="btn btn-link editJurusanAktif">
                    <span class="fa fa-edit"></span>
                </button>
            </p>


            @if(isset($_GET['q']) && $_GET['q'] != '')
            <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
            @endif
            </div>
            <form method="GET" action="{{ route('admin.jurusan.index') }}">
                <div class="col form-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari jurusan..">
                </div>
            </form>
        </div>

        @if($jurusan->count() <= 0)
        <h4 class="card-subtitle">Tidak ada jurusan</h4>

        @else
        <table class="table">
            <thead>
                <th>#</th>
                <th>Jurusan</th>
                <th>Kelas</th>
                <th>Deskripsi</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($jurusan as $key => $row)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$row->nama_jurusan}}</td>
                    <td>{{$row->kelas->count()}}</td>
                    <td>{{$row->deskripsi_jurusan == '' ? 'Tidak ada deskripsi.' : $row->deskripsi_jurusan}}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{ route('admin.jurusan.edit', $row->id_jurusan) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                        <a href="{{ route('admin.jurusan.delete', $row->id_jurusan) }}" class="btn btn-danger remove {{$row->kelas->count() > 0 ? 'disabled' : ''}}"><span class="fa fa-trash"></span></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $jurusan->appends(Request::except('page'))->links() }}

        @endif
    </div>
</div>

<!-- Modal edit detail -->
<div class="modal fade" id="editDetail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Jurusan yang aktif </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="POST" id="formEditDetail" action="{{route('admin.jurusan.setJurusanAktif')}}">
      <div class="modal-body">
            @csrf
            <div class="form-group">
                <select name="id_jurusan" class="form-control">
                    @foreach($jurusan as $option)
                    <option value="{{$option->id_jurusan}}">{{$option->nama_jurusan}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- END modal -->

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {

        $('.editJurusanAktif').click(function(e) {

            $('#editDetail').modal();

        });

    });
</script>
@stop