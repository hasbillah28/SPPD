
<div class="modal fade" id="modalUpload" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">Upload Bukti Perjalanan Dinas</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUpload" method="POST" action="{{ route('bukti.upload', $perjalananUser->perjalanan_dinas_id) }}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" required type="file" name="upload" id="uploadBukti">

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Tutup</button>
                        <button class="btn btn-success text-white" type="submit">Upload dan Selesaikan Perjalanan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
