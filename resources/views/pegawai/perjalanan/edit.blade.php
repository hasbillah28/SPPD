@extends('layouts.app')

@section('content')
    <form action="{{ route('pegawai.perjalanan.update', $perjalanan->id) }}" method="POST">
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
                                <input  name="tempat" type="text" class="form-control @error('tempat') is-invalid @enderror" value="{{ $perjalanan->tempat }}">
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
                                <textarea  name="deskripsi" type="text" rows="9" class="form-control @error('deskripsi') is-invalid @enderror">{{ $perjalanan->deskripsi }}</textarea>
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
                                <select required name="angkutan" class="form-select angkutan" id="">
                                    <option disabled value="">Pilih Jenis Angkutan</option>
                                    @foreach ($angkutans as $angkutan)
                                        @if($angkutan == $perjalanan->angkutan->nama_angkutan)
                                            <option selected value="{{ $angkutan->id }}">{{ $angkutan->nama_angkutan }}</option>
                                        @else
                                            <option value="{{ $angkutan->id }}">{{ $angkutan->nama_angkutan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('angkutan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label" for="">Anggaran</label>
                            <div>
                                <select required name="anggaran"  class="form-select" id="">
                                    <option disabled selected value="">Pilih Anggaran</option>
                                    <option selected value="apbd">Anggaran Kantor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tempat Berangkat</label>
                                <input type="text"  name="tempat_berangkat" class="form-control @error('tempat_berangkat') is-invalid @enderror" value="{{ $perjalanan->tempat_berangkat }}">
                                @error('tempat_berangkat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tanggal Berangkat</label>
                                <input type="date"  name="tanggal_berangkat" class="form-control @error('tanggal_berangkat') is-invalid @enderror" value="{{ $perjalanan->tanggal_berangkat }}">
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
                                <input type="text"  name="tempat_tujuan" class="form-control @error('tempat_tujuan') is-invalid @enderror" value="{{ $perjalanan->tempat_tujuan }}">
                                @error('tempat_tujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="">Tanggal Kembali    </label>
                                <input type="date"  name="tanggal_kembali" class="form-control @error('tanggal_berangkat') is-invalid @enderror" value="{{ $perjalanan->tanggal_kembali }}">
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
                {{--<a href="{{ route('pegawai.perjalanan') }}" type="button" class="btn btn-secondary">Cancel</a>--}}
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>


@endsection
