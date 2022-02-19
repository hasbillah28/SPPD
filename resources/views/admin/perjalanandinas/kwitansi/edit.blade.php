@extends('layouts.app')

@section('content')
    <div class="col-11 mb-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Buat Kwitansi
            </div>

            <div class="card-body">
                <form action="{{ route('kwitansi.update', $kwitansi->id) }}" method="post" class="row">
                    @csrf
                    @method('patch')
                    <div class="col-6 mb-3">
                        <label for="nomorSppd" class="form-label">Nomor SPPD</label>
                        <input type="text" class="form-control disabled" name="nomorSppd" id="nomorSppd" disabled value="{{ $kwitansi->sppd->no_sppd }}">
                    </div>

                    <div class="col-6">
                        <label for="nomorSppd" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control disabled" name="nomorSppd" id="nomorSppd" disabled value="{{ $kwitansi->sppd->user->name }}">
                    </div>

                    <div class="col-6 mb-3">
                        <label for="durasi" class="form-label">Durasi Perjalanan dalam Hari</label>
                        <input type="number" disabled class="form-control disabled" value="{{ $dayInterval }}" name="durasi" id="durasi">
                    </div>

                    <div class="col-6 mb-3">
                        <label for="nomorBukti" class="form-label">Nomor Bukti</label>
                        <input type="text" class="form-control" name="nomorBukti" id="nomorBukti">
                    </div>


                    <div class="col-6 mb-3">
                        <label for="mataAnggaran1" class="form-label">Mata Anggaran 1</label>
                        <input type="text" class="form-control" name="mataAnggaran1" id="mataAnggaran1" required>
                    </div>


                    <div class="col-6 mb-3">
                        <label for="mataAnggaran2" class="form-label">Mata Anggaran 2</label>
                        <input type="text" class="form-control" name="mataAnggaran2" id="mataAnggaran2" required>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="uangHarian" class="form-label">Uang Harian</label>
                        <input type="number" class="form-control" name="uangHarian" id="uangHarian" required>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="jumlah" class="form-label">Jumlah Uang</label>
                        <input type="text" class="form-control disabled" name="jumlah" id="jumlah" disabled>
                    </div>

                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-auto mb-3">
                                <a class="btn btn-info text-white">Back</a>
                            </div>

                            <div class="col-auto mb-3">
                                <button type="submit" class="btn btn-success text-white">Save</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById("uangHarian").onchange = function () {
            sumUang()
        };

        function sumUang() {
            const uang = document.getElementById("uangHarian");
            const durasi = document.getElementById("durasi");
            var jumlah = document.getElementById("jumlah");

            jumlah.value = "Rp."+(uang.value * durasi.value)+",-";
        }
    </script>
@endsection
