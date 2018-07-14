@extends('layouts.app')

@section('css')
<style type="text/css">

    .table-hover tbody tr:hover {
      background-color: #3498DB;
      color: white;
    }

</style>
@stop

@section('content')

@if(Request::segment(3) == 'hasil-akhir')
<a href="{{route('admin.penilaian.export-excel')}}" class="btn btn-outline-success add">Export Penilaian</a>
@elseif(Request::segment(3) == 'hasil-akhir-real')
<a href="{{route('admin.penilaian.export-excel-real')}}" class="btn btn-outline-success add">Export Penilaian</a>
@endif

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			
			<div class="card-title row">
				<div class="col">
					<h4>Penilaian 
						<span class="text-info">
						@if(Request::segment(3) == 'hasil-akhir')
						[Pra UKK]
						@elseif(Request::segment(3) == 'hasil-akhir-real')
						[Real UKK]
						@endif
						</span>
						<span class="text-primary">{{ $tahunAktif->tahunAjar->tahun_ajar }}</span>
					</h4>

					{{-- @if(isset($_GET['q']) && $_GET['q'] != '')
	                <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
	                @endif --}}
	                <a href="{{ url()->previous() }}"><span class="fa fa-arrow-left"></span> Kembali</a>

				</div>

				{{-- <div class="col-md-3">
	                <form method="GET" action="{{ route('admin.penilaian.export') }}">
                        <input type="text" name="q" class="form-control" placeholder="No. Ujian atau Nama peserta...">
	                </form>
	            </div> --}}

			</div>

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

			<div class="float-left">
				{{ $arrNilai->appends(Request::except('page'))->render() }}
			</div>

		</div>
	</div>
</div>

@stop

@section('js')

@stop