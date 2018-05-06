<button class="btn btn-outline-success add" data-toggle="modal" data-target="#addDokumenModal">
    <span class="fa fa-plus"></span> Tambah Dokumen
</button>

<div class="modal fade" tabindex="-1" role="dialog" id="addDokumenModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Dokumen Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="{{route('admin.dokumen-asesor.create', $asesor->id_asesor)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_dokumen">Pilih Dokumen</label>
                <input type="file" id="nama_dokumen" name="nama_dokumen" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" required />
            </div>

            <div class="float-right">
                <button class="btn btn-primary">Upload</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>