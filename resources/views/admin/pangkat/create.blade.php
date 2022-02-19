<div class="modal fade" id="staticBackdropLive" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Pangkat</h5>
          <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('pangkat.store') }}">
                @csrf
                <label for="nama_pangkat" class="form-label"> Nama Pangkat</label>
                <div class="input-group mb-3">
                    <input id="nama_pangkat" class="form-control" name="nama_pangkat" value="{{ old('nama_pangkat') }}" autocomplete="nama_pangkat">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>
