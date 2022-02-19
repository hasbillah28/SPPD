@extends('layouts.app')

@section('content')
    @include('admin.sppd.modal')
    <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mt-2">
                Daftar Surat Perjalanan Dinas
            </div>

            <div>
                    <button class="btn btn-sm" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" ><i class="icon fas fa-print"></i> Cetak Rekap</button>
            </div>
        </div>

        <div class="card-body">
            @php
                $i = 0
            @endphp
            <table id="table" class="table table-striped-border">
                <thead>
                <tr class="align-middle">
                    <th>No</th>
                    <th>No SPPD</th>
                    <th class="text-center">Pegawai</th>
                    <th class="text-center">Instansi Tujuan</th>
                    <th class="text-center">No Surat Tugas</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($sppd as $surat)
                    @if($surat->perjalanan->no_surat_tugas != null)
                    <tr class="align-middle">
                        <td class="mt-5">{{ ++$i }}</td>
                        <td>{{ $surat->no_sppd }}</td>
                        <td class="text-center">{{ $surat->user->name }}</td>
                        <td class="text-center">{{ $surat->perjalanan->tempat }}</td>
                        <td class="text-center">{{ $surat->perjalanan->no_surat_tugas }}</td>
                        <td class="text-center">
                            <a title="Cetak SPPD" class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('perjalanan.anggota.print', [$surat->perjalanan_dinas_id, $surat->user_id]) }}">
                                <i class="icon fas fa-print"></i></a>
                        </td>
                    </tr>
                    @endif
                @empty
                    <tr class="text-center">
                        <td colspan="6">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div>
                    {{ $sppd->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
