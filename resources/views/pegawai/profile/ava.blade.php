<div class="modal fade" id="staticBackdropLive" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">Upload Avatar Baru</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.ava.upload', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input class="form-control" type="file" name="avatar" id="uploadBukti">

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Tutup</button>
                        <button class="btn btn-success text-white" type="submit">Ganti Avatar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
