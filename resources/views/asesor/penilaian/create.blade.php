@extends('layouts.app')

@section('css')

@stop

@section('content')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			
			<h4 class="card-title">
		        Penilaian | <span class="text-info">{{ $peserta->nama }}</span>
		    </h4>

		    <br>

		    <div class="row">

		        <div class="col">
		            <table class="table">
		                <tr>
		                    <td>ID Peserta</td>
		                    <td>{{ $peserta->id_peserta }}</td>
		                </tr>

		                <tr>
		                	<td>Kelas</td>
		                	<td>{{ $peserta->kelas->nama_kelas }}</td>
		                </tr>

		                <tr>
		                    <td>Tanggal Lahir</td>
		                    <td>{{ date('d M Y', strtotime($peserta->tanggal_lahir)) }}</td>
		                </tr>
		                <tr>
		                    <td>Jenis Kelamin</td>
		                    <td>{{ $peserta->jenis_kelamin }}</td>
		                </tr>
		            </table>
		        </div>

		        <div class="col">
		            <table class="table">
		            	<tr>
		                    <td>Alamat</td>
		                    <td>{{ $peserta->alamat }}</td>
		                </tr>
		                <tr>
		                    <td>Email</td>
		                    <td>{{ $peserta->email }}</td>
		                </tr>
		                <tr>
		                    <td>Kontak</td>
		                    <td>{{ $peserta->kontak }}</td>
		                </tr>
		                <tr>
		                    <td>Tahun Ajar</td>
		                    <td>{{ $peserta->tahunAjar->tahun_ajar }}</td>
		                </tr>
		            </table>
		        </div>

		    </div>

		</div>

	</div>

	<!-- Form Penilaian -->

	<form method="POST" action="{{route('asesor.penilaian.create', $peserta->id_peserta)}}">
		@csrf
	<div class="card card-body mt-3">
			
		<h4 class="card-title">Paket Soal</h4>

		<div class="form-group">
			<input class="form-control" type="text" name="paket_soal" required>
		</div>

	</div>

	<div class="card card-body mt-3">
    	
		<button class="btn btn-primary btn-block" type="submit">Mulai Penilaian</button>

    </div>

	</form>
</div>

@stop

@section('js')

@stop