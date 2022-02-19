@extends('layouts.app')

@section('content')
<form action="{{ route('admin.perjalanan.store') }}" method="POST">
@csrf
<div class="row mb-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Perjalanan
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-5 col-form-label" for="">Instansi Tujuan</label>
                    <div class="">
                        <input name="tempat" type="text" value="{{ old('tempat') }}" class="form-control @error('tempat') is-invalid @enderror">

                        @error('tempat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-5 col-form-label" for="">Deskripsi Perjalanan</label>
                    <div class="">
                        <textarea name="deskripsi" type="text" rows="9" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Keberangkatan
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-form-label" for="">Jenis Angkutan</label>
                    <div>
                        <select name="angkutan" class="form-select @error('angkutan') is-invalid @enderror" id="select">
                            <option disabled selected value="">Pilih Jenis Angkutan</option>
                            @foreach ($angkutans as $angkutan)
                            <option value="{{ $angkutan->id }}">{{ $angkutan->nama_angkutan }}</option>
                            @endforeach
                        </select>

                        @error('angkutan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div id="anggaran" hidden class="row mb-3">
                    <label class="col-form-label" for="">Anggaran</label>
                    <div>
                        <select name="anggaran" class="form-select @error('anggaran') is-invalid @enderror">
                            <option disabled selected value="">Pilih Anggaran</option>
                            <option selected value="apbd">Anggaran Kantor</option>
                        </select>

                        @error('anggaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="col-form-label" for="">Tempat Berangkat</label>
                        <input type="text"  name="tempat_berangkat" value="{{ old('tempat_berangkat') }}" class="form-control @error('tempat_berangkat') is-invalid @enderror">

                        @error('anggaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="col-form-label" for="">Tanggal Berangkat</label>
                        <input type="date"  name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" class="form-control @error('tanggal_berangkat') is-invalid @enderror">

                        @error('tanggal_berangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                    <label class="col-form-label" for="">Tempat Tujuan</label>
                        <input type="text"  name="tempat_tujuan" value="{{ old('tempat_tujuan') }}" class="form-control @error('tempat_tujuan') is-invalid @enderror">

                        @error('tempat_tujuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                    <label class="col-form-label" for="">Tanggal Kembali</label>
                        <input type="date"  name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" class="form-control @error('tanggal_kembali') is-invalid @enderror">
                        @error('tanggal_kembali')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('perjalanan.index') }}" type="button" class="btn btn-secondary justify-content-end">Cancel</a>
    </div>

    <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
</form>


@endsection

@section('script')
    <script type="text/javascript">
        const select = document.getElementById("select")
        const anggaran = document.getElementById("anggaran")

        select.addEventListener('change', function () {
            anggaran.hidden = false
        })
    </script>
@endsection
