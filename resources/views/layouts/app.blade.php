<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UKKPK') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
    .add {
        position: fixed;
        bottom: 35px;
        right: 35px;
        z-index: 1000;
    }

    .add-two {
        position: fixed;
        bottom: 35px;
        right: 255px;
        z-index: 1000;
    }

    .notifikasi {
       position: absolute;
       top: 0px;
       right: 0;
       bottom: 0px;
       left: 815px;
       z-index: 10040;
       overflow: auto;
       overflow-y: auto;
    }
    </style>

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::check())

                            <li style="border-left: 2px solid #3498ab; padding-right: 1px;"></li>

                            @if(Auth::user()->akses == 'administrator')

                            <li><a class="nav-link" href="{{ route('admin.asesor.index') }}">ASESOR</a></li>
                            <li><a class="nav-link" href="{{ route('admin.tahun-ajar.index') }}">TAHUN AJAR</a></li>
                            <li><a class="nav-link" href="{{ route('admin.peserta.index') }}">PESERTA</a></li>
                            <li><a class="nav-link" href="{{ route('admin.kelas.index') }}">KELAS</a></li>
                            <li><a class="nav-link" href="{{ route('admin.jurusan.index') }}">JURUSAN</a></li>
                            <li><a class="nav-link" href="{{ route('admin.perusahaan.index') }}">PERUSAHAAN</a></li>
                            <li><a class="nav-link" href="{{ route('admin.komponen.index') }}">KOMPONEN</a></li>
                            <li><a class="nav-link" href="{{route('asesor.penilaian.index')}}">PENILAIAN</a></li>

                            @elseif(Auth::user()->akses == 'asesor')

                            <li><a href="{{route('asesor.data-asesor.edit')}}" class="nav-link">DATA DIRI</a></li>
                            <li><a href="{{route('asesor.dokumen-asesor.index')}}" class="nav-link">DOKUMEN</a></li>
                            <li><a href="{{route('asesor.penilaian.index')}}" class="nav-link">PENILAIAN</a></li>

                            @endif

                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registrasi Asesor') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Notifikasi lewat flash data -->
    @if(session('notification'))
        <script type="text/javascript">
            $(document).ready(function() {
                $('#popupmodal').modal({
                    backdrop: false
                });
                setTimeout(function() { $('#popupmodal').modal('hide'); }, 2000);
            });
        </script>

        <!-- Modal -->
        <div class="notifikasi modal fade" id="popupmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> -->
              <div class="modal-body bg-dark text-white">
                {!! session('notification') !!}
              </div>
            </div>
          </div>
        </div>
    @endif

    <script type="text/javascript">
    $('.remove').on('click', function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        if(confirm('Hapus data?')) {
            window.location.replace(url);
        }
    });

    $('#select_jurusan_1').change(function() {
        $.get("{{ url('api/dropdown') }}", {
            option : $(this).val()
        }, function(data) {
            var model = $('#select_parent_komponen_1');
            model.empty();

            model.append("<option value=''>Tidak ada</option>")

            $.each(data, function(index, element) {
                model.append("<option value='"+element.id_komponen+"'>" + element.komponen + "</option>")
            })
        });
    });

    $('#select_jurusan_2').change(function() {
        $.get("{{ url('api/dropdown') }}", {
            option : $(this).val()
        }, function(data) {
            var model = $('#select_parent_komponen_2');
            model.empty();

            model.append("<option value=''>Tidak ada</option>")

            $.each(data, function(index, element) {
                model.append("<option value='"+element.id_komponen+"'>" + element.komponen + "</option>")
            })
        });
    });
    </script>

    @yield('js')
</body>
</html>
