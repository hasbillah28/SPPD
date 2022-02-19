<div class="modal fade" id="staticBackdropLive" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Jabatan</h5>
          <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('jabatan.store') }}">
                @csrf
                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                <div class="input-group mb-3">
                    <input id="nama_perjalanan" class="form-control " name="nama_jabatan" value="{{ old('nama_jabatan') }}" autocomplete="nama_jabatan">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>
