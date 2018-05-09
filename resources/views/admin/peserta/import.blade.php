@extends('layouts.app')

@section('content')

<div class="container ">
	
	<div class="row justify-content-center">

	<div class="card card-body col-md-7">

		<h4 class="card-title">Import Peserta</h4>

		<hr>
		
		<form action="{{ route('admin.peserta.import') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				
				<label for="import_file">File yang akan di import</label>
				<input type="file" name="import_file" id="import_file" class="form-control">
				<span class="text-muted">*file excel harus sesuai format <a href="{{ asset('image/format_peserta.png') }}" target="_blank">berikut</a></span>

			</div>

			<div class="form-group">
				<button class="btn btn-primary">Upload</button>
			</div>

		</form>

	</div>

	</div>

</div>

@stop