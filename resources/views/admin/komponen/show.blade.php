@extends('layouts.app')

@section('css')

@stop

@section('content')

@if($komponen['indikator']->count() < 4)
<a href="{{ route('admin.indikator.create', $komponen->id_komponen) }}" class="btn btn-outline-success add">Tambah indikator</a>
@endif

<div class="container-fluid row justify-content-center">
    
    <div class="card card-body col-9">
        <a href="{{ route('admin.komponen.index') }}"><span class="fa fa-arrow-left"></span> Kembali</a>

        <h4 class="card-title">Komponen</h4>
        <p class="card-subtitle pb-2">
            <span>{{$komponen->komponen}}</span> | <span class="text-success">{{$komponen->jurusan->nama_jurusan}}</span>
        </p>

        <div class="btn-group">
            <button data-toggle="modal" data-target="#editKomponen" data-backdrop="false" class="btn btn-warning"><span class="fa fa-edit"></span> {{__('Edit Komponen')}}</button>
            <a href="{{route('admin.komponen.delete', $komponen->id_komponen)}}" class="btn btn-danger remove"><span class="fa fa-trash"></span> {{__('Hapus Komponen')}}</a>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editKomponen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Komponen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.komponen.update', $komponen->id_komponen)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Komponen</label>
                        <textarea name="komponen" class="form-control">{{ $komponen->komponen }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Parent Komponen</label>
                        <select name="parent_komponen" class="form-control">
                            
                            <option value="" {{ $komponen->parent_komponen == null ? 'selected' : '' }}>NULL</option>

                            @foreach($semuaKomponen as $parent)

                            <option value="{{$parent->id_komponen}}" {{$parent->id_komponen == $komponen->parent_komponen ? 'selected' : '' }}>{{$parent->komponen}}</option>

                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <br>

        <table class="table">
            
            <thead>
                <th>Indikator</th>
                <th>Standar Skor</th>
                <th>Keterangan</th>
                <th></th>
            </thead>

            @foreach($komponen['indikator'] as $indikator)
            <tr>
                <td>{{ $indikator->indikator }}</td>
                <td>{{ $indikator->standar_skor == 'tidak' ? '0 (tidak ada skor)' : $indikator->standar_skor }}</td>

                @switch($indikator->standar_skor)
                    @case('9,0 - 10')
                    <td>Sangat Kompeten</td>
                    @break
                    @case('8,0 - 8,9')
                    <td>Kompeten</td>
                    @break
                    @case('7,0 - 7,9')
                    <td>Cukup Kompeten</td>
                    @break
                    @case('tidak')
                    <td>Tidak</td>
                    @break
                @endswitch

                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.indikator.edit', $indikator->id_indikator) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                        <a href="{{ route('admin.indikator.delete', $indikator->id_indikator) }}" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
                    </div>
                </td>
            </tr>
            @endforeach

        </table>

    </div>

</div>
@endsection

@section('js')

@stop