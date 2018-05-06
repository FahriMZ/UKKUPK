@extends('layouts.app')

@section('css')

@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">

    <div class="card card-body col-7">
        <h3 class="card-title">Edit Indikator</h3>

        <p class="card-subtitle">{{$indikator->komponen->komponen}}</p>

        <hr>

        <form method="POST" action="{{ route('admin.indikator.edit', $indikator->id_indikator) }}">
            @csrf
            <div class="form-group">
                <label for="indikator">Indikator</label>
                <textarea name="indikator" class="form-control" required>{{$indikator->indikator}}</textarea>
            </div>

            <div class="form-group">
                <label for="standar_skor">Standar Skor</label>
                <select name="standar_skor" class="form-control">
                    @switch($indikator->standar_skor)
                        @case('9,0 - 10')
                        <option selected>9,0 - 10</option>
                        <option>8,0 - 8,9</option>
                        <option>7,0 - 7,9</option>
                        <option value="tidak">0 (Tidak ada skor)</option>
                        @break
                        @case('8,0 - 8,9')
                        <option>9,0 - 10</option>
                        <option selected>8,0 - 8,9</option>
                        <option>7,0 - 7,9</option>
                        <option value="tidak">0 (Tidak ada skor)</option>
                        @break
                        @case('7,0 - 7,9')
                        <option>9,0 - 10</option>
                        <option>8,0 - 8,9</option>
                        <option selected>7,0 - 7,9</option>
                        <option value="tidak">0 (Tidak ada skor)</option>
                        @break
                        @case('tidak')
                        <option>9,0 - 10</option>
                        <option>8,0 - 8,9</option>
                        <option>7,0 - 7,9</option>
                        <option selected value="tidak">0 (Tidak ada skor)</option>
                        @break
                    @endswitch
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