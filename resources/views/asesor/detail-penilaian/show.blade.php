@extends('layouts.app')

@section('content')

<div class="container">
	@if($detailPenilaian)

	<div class="card card-body">

        

        <div class="card-title row">
            <div class="col">
                <h3>Detail Penilaian</h3>
                <p class="card-subtitle text-info">{{ $peserta->nama }}</p>
                <br>

                @if(isset($_GET['q']) && $_GET['q'] != '')
                <code>hasil pencarian : "{{ $_GET['q'] }}"</code>
                @endif
            </div>

            <form method="GET" action="{{ route('asesor.detail-penilaian.show', $peserta->id_peserta) }}">
                <div class="col form-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari komponen/skor..">
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Komponen</th>
                    <th>Parent Komponen</th>
                    <th colspan="2">Skor</th>
                </thead>
                <tbody>

                    @foreach($detailPenilaian as $key => $komponen)
                    <tr>
                        <td>{{ $detailPenilaian->firstItem() + $key}}</td>
                        <td>{{$komponen->komponen}}</td>
                        <td>{{$komponen->parent->komponen}}</td>
                        <td>{{$komponen->skor}}</td>
                        <td><button data-komponen="{{$komponen->komponen}}" data-skor="{{ $komponen->skor }}" data-url="{{route('asesor.detail-penilaian.edit', $komponen->id_detail_penilaian)}}" class="btn btn-sm btn-warning editSkor"><span class="fa fa-edit"></span></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $detailPenilaian->render() }}
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


     </div>
    @endif
</div>

@stop

@section('js')

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