@extends('layouts.app')

@section('css')

@stop

@section('content')

<a href="{{route('admin.penilaian.export')}}" class="btn btn-outline-success add">Export Penilaian</a>

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			
			<h4 class="card-title">Penilaian <span class="text-primary">{{ $tahunAktif->tahunAjar->tahun_ajar }}</span> </h4>

			<br>


			<div class="table-responsive">
				
				<table class="table table-hover table-bordered">
					<thead>
						<th>#</th>
						<th>No. Ujian</th>
						<th>Nama</th>
						
						@foreach($komponenUtama as $komponen)

						<th>{{$komponen->komponen}}</th>

						@endforeach

						<th>Total</th>
					</thead>

					<tbody>
						
						@foreach($arrNilai as $key => $data)

						<tr>
							
							<td>{{++$key}}</td>
							<td>{{$data['id_peserta']}}</td>
							<td>{{$data['nama']}}</td>
							
							@foreach($data['nilai'] as $key => $nilai)
							<td>{{$nilai}}</td>
							@endforeach

							<td>{{$data['total']}}</td>

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