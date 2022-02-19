<div class="modal fade" id="editStaticModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">Modal title</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.golongan.update') }}" method="post" id="editForm">
                    @csrf
                    @method('patch')
                    <label for="nama_golongan" class="form-label"> Nama Golongan</label>
                    <div class="input-group mb-3">
                        <input type="hidden" name="id" id="idGolongan" value="{{ old('idGolongan') }}" autocomplete="idGolongan">
                        <input id="editNamaGolongan" class="form-control" name="nama_golongan" value="{{ old('nama_golongan') }}" autocomplete="nama_golongan">
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
