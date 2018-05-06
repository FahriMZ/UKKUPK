@extends('layouts.app')

@section('content')

<div class="container">
	@if($detailPenilaian)

	<div class="card card-body">

		<h4>Detail Penilaian</h4>

        <table class="table">
        	<thead>
        		<th>#</th>
        		<th>Komponen</th>
        		<th>Parent Komponen</th>
        		<th>Skor</th>
        	</thead>
        	<tbody>

                @foreach($detailPenilaian as $key => $komponen)
                <tr>
        			<td>{{ $detailPenilaian->firstItem() + $key}}</td>
        			<td>{{$komponen->komponen}}</td>
        			<td>{{$komponen->parent->komponen}}</td>
        			<td>{{$komponen->skor}}</td>
        		</tr>
        		@endforeach
        	</tbody>
        </table>

        {{ $detailPenilaian->links() }}

     </div>
    @endif
</div>

@stop