@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card card-body mb-3">
        <h4 class="card-title">
            {{ $peserta->nama }}
            <div class="float-right">
                <a href="{{ route('admin.peserta.edit', $peserta->id_peserta) }}" class="btn btn-warning"><span class="fa fa-edit"></span> Edit</a>
                <a href="{{ route('admin.peserta.delete', $peserta->id_peserta) }}" class="btn btn-danger remove"><span class="fa fa-trash"></span> Hapus</a>
            </div>
        </h4>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <td>ID Peserta</td>
                    <td>{{ $peserta->id_peserta }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>{{ date('d M Y', strtotime($peserta->tanggal_lahir)) }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>{{ $peserta->jenis_kelamin }}</td>
                </tr>
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
@stop