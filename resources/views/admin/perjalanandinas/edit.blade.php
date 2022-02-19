@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('perjalanan.update', $perjalanan->id) }}" method="POST">
        @csrf
        @method('patch')
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
                                <input required name="tempat" type="text" class="form-control" value="{{ $perjalanan->tempat }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="">Deskripsi Perjalanan</label>
                            <div class="">
                                <textarea required name="deskripsi" type="text" rows="9" class="form-control">{{ $perjalanan->deskripsi }}</textarea>
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
                                <select required name="angkutan" class="form-select" id="">
                                    <option disabled value="">Pilih Jenis Angkutan</option>
                                    @foreach ($angkutans as $angkutan)
                                        @if($angkutan == $perjalanan->angkutan->nama_angkutan)
                                            <option selected value="{{ $angkutan->id }}">{{ $angkutan->nama_angkutan }}</option>
                                        @else
                                            <option value="{{ $angkutan->id }}">{{ $angkutan->nama_angkutan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label" for="">Anggaran</label>
                            <div>
                                <select required name="anggaran" required class="form-select" id="">
                                    <option disabled selected value="">Pilih Anggaran</option>
                                    <option selected value="apbd">APBD</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tempat Berangkat</label>
                                <input type="text" required name="tempat_berangkat" class="form-control" value="{{ $perjalanan->tempat_berangkat }}">
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tanggal Berangkat</label>
                                <input type="date" required name="tanggal_berangkat" class="form-control" value="{{ $perjalanan->tanggal_berangkat }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tempat Tujuan</label>
                                <input type="text" required name="tempat_tujuan" class="form-control" value="{{ $perjalanan->tempat_tujuan }}">
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tanggal Kembali    </label>
                                <input type="date" required name="tanggal_kembali" class="form-control" value="{{ $perjalanan->tanggal_kembali }}">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button href="{{ route('perjalanan.index') }}" type="button" class="btn btn-secondary justify-content-end">Cancel</button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>


@endsection
