@extends('layouts.app')

@section('content')
    @php
        $i = 0
    @endphp
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mt-2">
                Riwayat Perjalanan User
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped-border">
                <thead>
                <tr>
                    <th>No</th>
                    <th>No SPPD</th>
                    <th>No Surat Tugas</th>
                    <th>Instansi Tujuan</th>
                    <th>Tanggal Berangkat</th>
                    <th>Tempat Tujuan</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($anggotas as $anggota)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $anggota->no_sppd }}</td>
                        <td>{{ $anggota->perjalanan->no_surat_tugas }}</td>
                        <td>{{ $anggota->perjalanan->tempat }}</td>
                        <td>{{ $anggota->perjalanan->tanggal_berangkat }}</td>
                        <td>{{ $anggota->perjalanan->tempat_tujuan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
