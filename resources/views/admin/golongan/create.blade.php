<div class="modal fade" id="staticBackdropLive" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Golongan</h5>
          <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('golongan.store') }}">
                @csrf
                <label for="nama_golongan" class="form-label"> Nama Golongan</label>
                <div class="input-group mb-3">
                    <input id="nama_golongan" class="form-control" name="nama_golongan" value="{{ old('nama_golongan') }}" autocomplete="nama_golongan">

                   {{-- @error('nama_golongan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror--}}
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
