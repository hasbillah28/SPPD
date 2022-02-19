<div class="modal fade" id="staticBackdropLive" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Jenis Angkutan</h5>
          <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('angkutan.store') }}">
                @csrf
                <label for="nama_angkutan" class="form-label"> Nama Jenis Angkutan</label>
                <div class="input-group mb-3">
                    <input id="nama_angkutan" class="form-control" name="nama_angkutan" value="{{ old('nama_angkutan') }}" autocomplete="nama_angkutan">

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
