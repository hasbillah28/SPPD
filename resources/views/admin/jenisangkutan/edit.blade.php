<div class="modal fade" id="editStaticModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">Modal title</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.angkutan.update') }}" method="post" id="editForm">
                    @csrf
                    @method('patch')
                    <label for="nama_jabatan" class="form-label"> Nama Angkutan</label>
                    <div class="input-group mb-3">
                        <input type="hidden" name="id" id="idJabatan" value="{{ old('id') }}" autocomplete="id">
                        <input id="editNamaJabatan" class="form-control" name="nama_angkutan" value="{{ old('nama_angkutan') }}" autocomplete="nama_angkutan">
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
