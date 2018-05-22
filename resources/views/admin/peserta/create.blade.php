@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('admin.peserta.store') }}">
@csrf
<div class="container-fluid">
    <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-danger text-white">{{ __('Data Diri') }}</div>

            <div class="card-body">

                <a href="{{ url()->previous() }}"><span class="fa fa-arrow-left"></span> Kembali</a>

                    <div class="form-group row">
                        <label for="id_peserta" class="col-md-4 col-form-label text-md-right">{{ __('ID Peserta') }}</label>

                        <div class="col-md-6">
                            <input id="id_peserta" type="text" class="form-control{{ $errors->has('id_peserta') ? ' is-invalid' : '' }}" name="id_peserta" value="{{ old('id_peserta') }}" required autofocus placeholder="ex. 01-111-029-2">

                            @if ($errors->has('id_peserta'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_peserta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">{{ __('Jenis kelamin') }}</label>

                        <div class="col-md-6">
                            <select id="jenis_kelamin" class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>

                            @if ($errors->has('jenis_kelamin'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal lahir') }}</label>

                        <div class="col-md-6">
                            <input id="tanggal_lahir" type="date" class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>

                            @if ($errors->has('tanggal_lahir'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                        <div class="col-md-6">
                            <textarea id="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" required>{{ old('alamat') }}</textarea>

                            @if ($errors->has('alamat'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kontak" class="col-md-4 col-form-label text-md-right">{{ __('Kontak') }}</label>

                        <div class="col-md-6">
                            <input id="kontak" type="text" class="form-control{{ $errors->has('kontak') ? ' is-invalid' : '' }}" name="kontak" value="{{ old('kontak') }}" required>

                            @if ($errors->has('kontak'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('kontak') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_tahun_ajar" class="col-md-4 col-form-label text-md-right">{{ __('Tahun ajaran') }}</label>

                        <div class="col-md-6">
                            <select name="id_tahun_ajar" class="form-control">
                                @foreach($tahunAjar as $tahun)
                                <option value="{{$tahun->id_tahun_ajar}}">{{$tahun->tahun_ajar}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_tahun_ajar'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_tahun_ajar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    </div>

    <div class="container-fluid form-group row mb-0">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</div>
</form>
@endsection
