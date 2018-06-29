@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('admin.asesor.update', $asesor->id_asesor) }}">
@csrf
<div class="container-fluid">
    <div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header bg-danger text-white">{{ __('Data Diri') }}</div>

            <div class="card-body">

                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ $asesor->nama or old('nama') }}" required autofocus>

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
                            <select id="jenis_kelamin" class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" name="jenis_kelamin" required>
                                @if($asesor->jenis_kelamin == 'Perempuan')
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan" selected="true">Perempuan</option>
                                @else
                                <option value="Laki-laki" selected="true">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                @endif
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
                            <input id="tanggal_lahir" type="date" class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" name="tanggal_lahir" value="{{ $asesor->tanggal_lahir or old('tanggal_lahir') }}" required>

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
                            <textarea id="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" required>{{ $asesor->alamat or old('alamat') }}</textarea>

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
                            <input id="kontak" type="text" class="form-control{{ $errors->has('kontak') ? ' is-invalid' : '' }}" name="kontak" value="{{ $asesor->kontak or old('kontak') }}" required>

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
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $asesor->user->email or old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-6 row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning">{{ __('Data Perusahaan') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_perusahaan" class="col-md-4 col-form-label text-md-right">{{ __('Nama perusahaan') }}</label>

                        <div class="col-md-6">
                            <select name="id_perusahaan" class="form-control">
                                @foreach($perusahaan as $row)
                                    <option value="{{ $row->id_perusahaan }}" 
                                        {{ $row->id_perusahaan == $asesor->id_perusahaan ? 'selected' : '' }}>
                                        {{ $row->nama_perusahaan }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_perusahaan')) 
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_perusahaan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_jurusan" class="col-md-4 col-form-label text-md-right">{{ __('Jurusan') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="id_jurusan">
                                @foreach($jurusan as $option)
                                <option value="{{$option->id_jurusan}}" {{ $option->id_jurusan == $asesor->id_jurusan ? 'selected' : '' }} >{{ $option->nama_jurusan }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_jurusan'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('id_jurusan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('Akun') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $asesor->user->username or old('username') }}" required>

                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                            <span class="text-muted">Kosongkan password jika tidak ingin diubah.</span>
                            <span class="text-muted">Default password : <code>123456</code></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container-fluid form-group row mb-0">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</div>
</form>
@endsection
