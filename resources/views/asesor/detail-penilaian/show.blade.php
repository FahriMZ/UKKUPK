@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card card-body mb-3">
        <div class="card-title row">
            <div class="col">
                <a href="{{ route('asesor.penilaian.index') }}"><span class="fa fa-arrow-left"></span> Kembali</a>
                <h3>Detail Penilaian</h3>
                <p class="card-subtitle text-info">{{ $peserta->nama }}</p>

                @if(isset($_GET['q']) && $_GET['q'] != '')
                <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
                @endif

                <br>

            </div>

            <div class="col-md-3">
                <form method="GET" action="{{ route('asesor.detail-penilaian.show', $peserta->id_peserta) }}">
                    <div class="col form-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari komponen/skor..">
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a href="#pills-home" class="nav-link active" id="pills-home-tab" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Pra UKK</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-about" class="nav-link" id="pills-about-tab" data-toggle="pill" role="tab" aria-controls="pills-about" aria-selected="true">Real UKK</a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::user()->akses == 'asesor' && Auth::user()->asesor->perusahaan->tipe_perusahaan == 'eksternal')
                        
                        <a href="{{route('asesor.penilaian.delete', $peserta->id_peserta)}}" class="nav-link text-danger remove"><span class="fa fa-trash"></span> Hapus Penilaian Real UKK</a>

                        @elseif(Auth::user()->akses == 'asesor' && Auth::user()->asesor->perusahaan->tipe_perusahaan == 'internal')

                        <a href="{{route('asesor.penilaian.delete', $peserta->id_peserta)}}" class="nav-link text-danger remove"><span class="fa fa-trash"></span> Hapus Penilaian Pra UKK</a>

                        @endif


                    </li>
                </ul>

            </div>

        </div>
    </div>

    {{-- ISI --}}

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-home" role="tab-panel" aria-labelledby="pills-home-tab">
                
            <div class="card card-body">

                @if($detailPenilaian_praukk->count() > 0)

                <h5>Asesor : </h5><p>{{ $asesor->where('tipe_ukk', 'pra ukk')->first()['nama'] }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Komponen</th>
                            <th>Parent Komponen</th>
                            <th>Skor</th>
                            <th colspan="2">Kompetensi</th>
                        </thead>
                        <tbody>

                            @foreach($detailPenilaian_praukk as $key => $komponen)
                            <tr>
                                <td>{{ $detailPenilaian_praukk->firstItem() + $key}}</td>
                                <td>{{$komponen->komponen}}</td>
                                <td>{{$komponen->parent->komponen}}</td>
                                <td>{{$komponen->skor}}</td>
                                <td>

                                    @switch(true)

                                        @case($komponen->skor < 7)
                                            Tidak
                                            @break
                                        @case($komponen->skor >= 7 && $komponen->skor < 8)
                                            CK
                                            @break
                                        @case($komponen->skor >= 8 && $komponen->skor < 9)
                                            K
                                            @break
                                        @case($komponen->skor >= 9 && $komponen->skor <= 10)
                                            SK
                                            @break
                                        @default
                                            Error
                                            @break

                                    @endswitch

                                </td>
                                
                                @if(Auth::user()->akses == 'asesor' && Auth::user()->asesor->id_asesor == $asesor->where('tipe_ukk', 'pra ukk')->first()['id_asesor'])

                                <td><button data-komponen="{{$komponen->komponen}}" data-skor="{{ $komponen->skor }}" data-url="{{route('asesor.detail-penilaian.edit', $komponen->id_detail_penilaian)}}" class="btn btn-sm btn-warning editSkor"><span class="fa fa-edit"></span></button></td>

                                @endif

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="float-right">
                        {{ $detailPenilaian_praukk->fragment('pills-home')->links() }}
                    </div>
                </div>

                @else 

                    <h5>Belum ada penilaian untuk pra ukk.</h5>

                    @if(Auth::user()->akses == 'asesor' && Auth::user()->asesor->perusahaan->tipe_perusahaan == 'internal')

                    <a href="{{route('asesor.penilaian.create', $peserta->id_peserta)}}"><span class="fa fa-plus"></span> Buat Penilaian</a>

                    @endif

                @endif
            </div>

        </div>

        <div class="tab-pane fade" id="pills-about" role="tab-panel" aria-labelledby="pills-about-tab">
            
            <div class="card card-body">

                @if($detailPenilaian_realukk->count() > 0)

                <h5>Asesor : </h5><p>{{ $asesor->where('tipe_ukk', 'real ukk')->first()['nama'] }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Komponen</th>
                            <th>Parent Komponen</th>
                            <th colspan="2">Skor</th>
                        </thead>
                        <tbody>

                            @foreach($detailPenilaian_realukk as $key => $komponen)
                            <tr>
                                <td>{{ $detailPenilaian_realukk->firstItem() + $key}}</td>
                                <td>{{$komponen->komponen}}</td>
                                <td>{{$komponen->parent->komponen}}</td>
                                <td>{{$komponen->skor}}</td>

                                @if(Auth::user()->akses == 'asesor' && Auth::user()->asesor->id_asesor == $asesor->where('tipe_ukk', 'real ukk')->first()['id_asesor'])

                                <td><button data-komponen="{{$komponen->komponen}}" data-skor="{{ $komponen->skor }}" data-url="{{route('asesor.detail-penilaian.edit', $komponen->id_detail_penilaian)}}" class="btn btn-sm btn-warning editSkor"><span class="fa fa-edit"></span></button></td>

                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="float-right">
                        {{ $detailPenilaian_realukk->fragment('pills-about')->links() }}
                    </div>
                </div>

                @else 

                <h5>Belum ada penilaian untuk real ukk.</h5>
                @if(Auth::user()->akses == 'asesor' && Auth::user()->asesor->perusahaan->tipe_perusahaan == 'eksternal')

                <a href="{{route('asesor.penilaian.create', $peserta->id_peserta)}}"><span class="fa fa-plus"></span> Buat Penilaian</a>

                @endif

                @endif

            </div>
            

        </div>

    </div>
</div>

        <!-- Modal edit detail -->
        <div class="modal fade" id="editSkor" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit skor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <form method="POST" id="formEditSkor">
              <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Komponen</label>
                        <textarea class="form-control komponen_textarea" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label>Skor</label>
                        <input type="number" name="skor" class="form-control komponen_skor" step="any" min="0" max="10">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
            </div>
          </div>
        </div>

        <!-- END modal -->

@stop

@section('js')

<script type="text/javascript">
    
    $('a[href="'+window.location.hash+'"]').tab('show');
    // console.log(window.location.hash);

</script>

<script type="text/javascript">
    
    $('.editSkor').click(function() {
        var komponen =  $(this).data('komponen');
        var skor =  $(this).data('skor');
        var url =  $(this).data('url');

        $('.modal-body .komponen_textarea').val(komponen);
        $('.modal-body .komponen_skor').val(skor);
        $('#formEditSkor').attr('action', url);

       $('#editSkor').modal({
        backdrop: false
       });
    });

</script>

@stop