@extends('layouts.app')

@section('content')

<div class="container-fluid">
	@if($komponen)
	<form action="{{ route('asesor.detail-penilaian.store', $penilaian->id_penilaian) }}" method="POST">
		@csrf

        @each('asesor.detail-penilaian.rec-detail', $komponen->where('parent_komponen', '=', null), 'kom')

        <button class="btn btn-primary btn-block">Save</button>
     </form>
    @endif
</div>

@stop