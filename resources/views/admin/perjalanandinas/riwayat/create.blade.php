@extends('layouts.app')

@section('content')
    <div class="card col-lg-10">
        <div class="card-header">
            Tambah Riwayat Disposisi Perjalanan
        </div>

        <form method="POST" action="{{ route('perjalanan.riwayat.store', $id) }}">
            @csrf
            <div class="card-body">
                <div class="row mb-3">

                    <div class="col-6">
                        <label class="form-label" for="tempatTiba">Tempat Kedatangan</label>
                        <input type="text" class="form-control @error('tempatKedatangan') is-invalid @enderror" id="tempatTiba" name="tempatKedatangan">
                        @error('tempatKedatangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label class="form-label @error('tanggalKedatangan') is-invalid @enderror" id="tempatTiba" for="tanggalTiba">Tanggal Kedatangan</label>
                        <input type="date" class="form-control" name="tanggalKedatangan" id="tanggalTiba">
                        @error('tanggalKedatangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="tempatTujuan" class="form-label">Tempat Tujuan</label>
                        <input type="text" class="form-control @error('tempatTujuan') is-invalid @enderror" id="tempatTujuan" name="tempatTujuan" id="tempatTujuan">
                        @error('tempatTujuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label for="tanggalBerangkat" class="form-label">Tanggal Berangkat</label>
                        <input type="date" class="form-control @error('tanggalBerangkat') is-invalid @enderror" id="tanggalBerangkat" name="tanggalBerangkat" id="tanggalBerangkat">
                        @error('tanggalBerangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success text-white">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
