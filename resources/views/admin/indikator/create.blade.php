@extends('layouts.app')

@section('css')

@stop

@section('content')

<div class="container">
    <div class="row">

    <div class="card card-body col-6">

        <h4>Komponen:</h4>
        <p>{{ $komponen->komponen }}</p>

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

    <div class="col-1"></div>

    <div class="card card-body col-5">
        <h3 class="card-title">Tambah Indikator</h3>

        <!-- <p class="card-subtitle">Komponen : {{$komponen->komponen}}</p> -->

        <hr>

        <form method="POST" action="{{ route('admin.indikator.create', $komponen->id_komponen) }}">
            @csrf
            <div class="form-group">
                <label for="indikator">Indikator</label>
                <textarea name="indikator" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="standar_skor">Standar Skor</label>
                <select name="standar_skor" class="form-control">
                    <option>9,0 - 10</option>
                    <option>8,0 - 8,9</option>
                    <option>7,0 - 7,9</option>
                    <option value="tidak">0 (Tidak ada skor)</option>
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary float-right col-3" type="submit">Save</button>
            </div>

        </form>

    </div>

    </div>
</div>
@endsection

@section('js')

@stop