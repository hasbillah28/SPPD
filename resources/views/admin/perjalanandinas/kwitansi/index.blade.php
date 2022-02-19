@extends('layouts.app')

@section('content')
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
                Daftar Kwitansi
            </div>
        </div>

        <div class="card-body">
            @php
                $i = 0
            @endphp
            <table id="table" class="table table-striped-border table-responsive">
                <thead>
                <tr class="align-middle">
                    <th>No</th>
                    <th class="text-center">No SPPD</th>
                    <th class="text-center">No Surat Tugas</th>
                    <th class="text-center">Nama Pegawai</th>
                    <th class="text-center">Tujuan</th>
                    <th class="text-center">Bukti Perjalanan</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($kwitansis as $kwitansi)
                    <tr class="align-middle">
                        <td class="mt-5">{{ ++$i }}</td>
                        <td class="text-center">{{ $kwitansi->sppd->no_sppd }}</td>
                        <td class="text-center">{{ $kwitansi->sppd->perjalanan->no_surat_tugas }}</td>
                        <td class="text-center">{{ $kwitansi->sppd->user->name }}</td>
                        <td class="text-center">{{ $kwitansi->sppd->perjalanan->tempat_tujuan }}</td>
                        <td class="text-center">
                            @if($kwitansi->status === '0' || $kwitansi->status === '1')
                            <a title="Lihat Bukti" class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('kwitansi.file', $kwitansi->id) }}">
                                <i class="icon fas fa-file"></i>
                            </a>
                            @else
                                <a title="Lihat Bukti" class="btn btn-info btn-sm text-white disabled" disabled="">
                                    <i class="icon fas fa-file"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            <form method="post" action="{{ route('kwitansi.pengajuan.tolak', $kwitansi->id) }}">
                                @csrf
                                @method('patch')
                                @if($kwitansi->status === '1')
                                    <a title="Print Kwitansi" class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('kwitansi.print', $kwitansi->id) }}">
                                        <i class="icon fas fa-print"></i></a>
                                @elseif($kwitansi->status === '0')
                                    <a title="Isi Form Kwitansi" class="btn disabled btn-info btn-sm text-white" disabled>
                                        <i class="icon fas fa-print"></i></a>
                                    <a  href="{{ route('kwitansi.edit', $kwitansi->id) }}" class="btn btn-sm btn-success text-white">
                                        <i class="icon fas fa-check" title="Terima Bukti"></i>
                                    </a>

                                    <button type="submit" class="btn btn-sm btn-danger text-white">
                                        <i class="icon fas fa-times" title="Tolak Bukti"></i>
                                    </button>

                                @elseif($kwitansi->status === '01')
                                    <a title="Isi Form Kwitansi" class="btn disabled btn-info btn-sm text-white" disabled>
                                        <i class="icon fas fa-print"></i></a>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div>
                    {{ $kwitansis->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
