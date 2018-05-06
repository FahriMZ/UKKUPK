@extends('layouts.app')

@section('css')

@stop

@section('content')

<div class="container-fluid">
    
    <div class="card card-body mb-3">
        <h3 class="card-title">Komponen</h3>

        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a href="#pills-home" class="nav-link active" id="pills-home-tab" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Semua Komponen</a>
            </li>
            <li class="nav-item">
                <a href="#pills-about" class="nav-link" id="pills-about-tab" data-toggle="pill" role="tab" aria-controls="pills-about" aria-selected="true">Komponen Utama</a>
            </li>
            <li class="nav-item">
                <a href="#pills-add" class="nav-link" id="pills-add-tab" data-toggle="pill" role="tab" aria-controls="pills-add" aria-selected="true">Tambah Komponen</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <!-- Tambah Komponen -->

        <div class="tab-pane fade" id="pills-add" role="tab-panel" aria-labelledby="pills-add-tab">
            
            <div class="card card-body mb-3">

                <h4 class="card-title">Tambah Komponen</h4>
                <hr>

                <form method="POST" action="{{route('admin.komponen.create')}}">
                    
                    @csrf

                    <div class="form-group">
                        <label for="komponen">Komponen</label>
                        <textarea name="komponen" id="komponen" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Parent Komponen</label>
                        <select name="parent_komponen" class="form-control">
                            <option value="">Tidak ada</option>
                            @foreach($komponen as $option)
                                <option value="{{$option->id_komponen}}">{{$option->komponen}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Save</button>
                    </div>

                </form>

            </div>

            <!-- Tambah komponen (Copy dari yang sudah ada) -->
            <div class="card card-body mb-3">

                <h4 class="card-title">Copy Komponen</h4>
                <hr>

                <form method="POST" action="{{route('admin.komponen.create-copy')}}">
                    
                    @csrf

                    <div class="form-group">
                        <label>Komponen</label>
                        <select name="komponen" class="form-control">
                            @foreach($komponen as $option)
                                <option value="{{$option->komponen}}">{{$option->komponen}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Parent Komponen</label>
                        <select name="parent_komponen" class="form-control">
                            <option value="">Tidak ada</option>
                            @foreach($komponen as $option)
                                <option value="{{$option->id_komponen}}">{{$option->komponen}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Save</button>
                    </div>

                </form>

            </div>

        </div>        

        <!-- END Tambah Komponen -->

        <!-- Semua Komponen -->

        <div class="tab-pane fade show active" id="pills-home" role="tab-panel" aria-labelledby="pills-home-tab">
            
            <div class="container card card-body mb-3">
                <form method="GET" action="{{ route('admin.komponen.index') }}">
                    <div class="col form-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari komponen..">
                    </div>
                </form>

                @if(isset($_GET['q']) && $_GET['q'] != '')
                <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
                @endif
            </div>

            @if($komponen)

                @each('rec-item', $komponen->where('parent_komponen', '=', null), 'kom')

                {{ $komponen->links() }}

            @endif
            

        </div>

        <!-- END Semua Komponen -->

        <!-- Komponen Utama -->

        <div class="tab-pane fade" id="pills-about" role="tab-panel" aria-labelledby="pills-about-tab">
            
            <div class="card card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Komponen</th>
                        <th>Sub komponen</th>
                        <th>Skor Maksimal</th>
                        <th>Bobot</th>
                        <th></th>
                    </thead>

                    <tbody>
                        @foreach($komponenUtama as $key => $komponen)
                        <tr>
                            <td>{{ $komponenUtama->firstItem() + $key}}</td>
                            <td>{{ $komponen->komponen }}</td>
                            <td>{{ $komponen->children->count() }}</td>
                        
                            @if($komponen->detailKomponen->count() > 0)
                            <td>{{ $komponen->detailKomponen[0]['skor_maksimal'] }}</td>
                            <td>{{ $komponen->detailKomponen[0]['bobot'] }}</td>
                            <td>
                                <button 
                                data-id="{{$komponen->id_komponen}}" 
                                data-komponen="{{$komponen->komponen}}"
                                data-skor="{{$komponen->detailKomponen[0]['skor_maksimal']}}"
                                data-bobot="{{$komponen->detailKomponen[0]['bobot']}}"
                                data-url="{{route('admin.detail-komponen.edit', $komponen->detailKomponen[0]['id_detail_komponen'])}}"
                                class="btn-sm btn-warning btn-block editDetail">
                                <span class="fa fa-edit"></span>
                                </button>
                            </td>
                            @else
                            <td colspan="3" align="center">
                            <button data-id="{{$komponen->id_komponen}}" data-komponen="{{$komponen->komponen}}" class="btn btn-primary addDetail" >Tambah skor maksimal dan bobot</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $komponenUtama->links() }}

                <!-- Modal tambah detail -->
                <div class="modal fade" id="tambahDetail" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Detail Komponen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <form method="POST" id="formAddDetail">
                      <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label>Komponen</label>
                                <input type="hidden" name="id_komponen" class="komponen_input">
                                <textarea class="form-control komponen_textarea" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label>Skor Maksimal</label>
                                <input type="number" name="skor_maksimal" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Bobot</label>
                                <input type="number" name="bobot" class="form-control" />
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

                <!-- Modal edit detail -->
                <div class="modal fade" id="editDetail" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Detail Komponen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <form method="POST" id="formEditDetail">
                      <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label>Komponen</label>
                                <input type="hidden" name="id_komponen" class="komponen_input">
                                <textarea class="form-control komponen_textarea" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label>Skor Maksimal</label>
                                <input type="number" name="skor_maksimal" class="form-control komponen_skor" />
                            </div>
                            <div class="form-group">
                                <label>Bobot</label>
                                <input type="number" name="bobot" class="form-control komponen_bobot" />
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

                <!-- END modal -->

            </div>


        </div>

        <!-- END Komponen Utama -->


    </div>

</div>
@endsection

@section('js')
<script type="text/javascript">
    
    // Edit detail komponen
    $('.editDetail').click(function() {
       var id_komponen =  $(this).data('id');
       var komponen =  $(this).data('komponen');
       var skor_maksimal =  $(this).data('skor');
       var bobot =  $(this).data('bobot');
       var url =  $(this).data('url');

        $('.modal-body .komponen_input').val(id_komponen);
        $('.modal-body .komponen_textarea').val(komponen);
        $('.modal-body .komponen_skor').val(skor_maksimal);
        $('.modal-body .komponen_bobot').val(bobot);
        $('#formEditDetail').attr('action', url);

       $('#editDetail').modal({
        backdrop: false
       });
    });

    // Tambah detail komponen
    $('.addDetail').click(function() {
       var id_komponen =  $(this).data('id');
       var komponen =  $(this).data('komponen');
       var url =  '{{route("admin.detail-komponen.create")}}';

        $('.modal-body .komponen_input').val(id_komponen);
        $('.modal-body .komponen_textarea').val(komponen);


        $('#formAddDetail').attr('action', url);

       $('#tambahDetail').modal({
        backdrop: false
       });
    });
</script>
@stop