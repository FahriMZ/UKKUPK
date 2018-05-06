@extends('layouts.app')

@section('css')

@stop

@section('content')

@if(Auth::user()->akses == 'administrator')
	<a href="{{ route('admin.penilaian.export') }}" class="btn btn-outline-success add">Lihat hasil akhir</a>
@endif


<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			
			<div class="card-title row">
		        <div class="col">
		            <h3>Penilaian</h3>

		            @if(isset($_GET['q']) && $_GET['q'] != '')
		            <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
		            @endif
		        </div>

		        <form method="GET" action="{{ route('asesor.penilaian.index') }}">
		            <div class="col form-group">
		                <input type="text" name="q" class="form-control" placeholder="Cari peserta..">
		            </div>
		        </form>
		    </div>
			
			<div class="table-responsive">
					
				<table class="table table-bordered">
					
					<thead>
						<th>#</th>
						<th>Nomor Peserta</th>
						<th>Nama</th>
						<th>Penilaian</th>
					</thead>

					<tbody>
						@foreach($peserta as $key => $row)
						<tr>
							<td>{{++$key}}</td>
							<td>{{$row->id_peserta}}</td>
							<td>{{$row->nama}}</td>

							@if($row->penilaian->count() > 0)
							<td>
								<div class="btn-group">
								<a href="{{route('asesor.detail-penilaian.show', $row->id_peserta)}}" class="btn btn-info"><span class="fa fa-eye"></span> Lihat Penilaian</a>
								<a href="{{route('asesor.penilaian.delete', $row->id_peserta)}}" class="btn btn-danger remove"><span class="fa fa-trash"></span> Hapus Penilaian</a>
								</div>
							</td>

							@else
							<td>
							@if(Auth::user()->akses == 'asesor')
								<a href="{{route('asesor.penilaian.create', $row->id_peserta)}}" class="btn btn-primary"><span class="fa fa-pencil"></span> Buat Penilaian</a>
							@else
								<a href="{{route('asesor.penilaian.create', $row->id_peserta)}}" class="btn btn-primary disabled"><span class="fa fa-pencil"></span> Buat Penilaian</a>
							@endif
							</td>
							@endif

						</tr>
						@endforeach
					</tbody>

				</table>

				</div>

		</div>
	</div>
</div>

@stop

@section('js')

@stop