<div class="modal fade" id="staticBackdropLive" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">Cetak Rekap SPPD</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" target="_blank" action="{{ route('admin.rekap.pilih') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-6 mb-3">
                            <label class="form-label" for="startDate">Tanggal Awal</label>
                            <input value="{{ old('startDate') }}" name="startDate" class="form-control @error('startDate') is-invalid @enderror" type="date" placeholder="dd-mm-yyyy">

                            @error('startDate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="form-label" for="endDate">Tanggal Akhir</label>
                            <input id="endDate" value="{{ old('endDate') }}" name="endDate" class="form-control @error('endDate') is-invalid @enderror" type="date" placeholder="dd-mm-yyyy">

                            @error('endDate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-info text-white">Cetak</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
