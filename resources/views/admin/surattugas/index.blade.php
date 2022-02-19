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
                Daftar Surat Tugas
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
                    <th>Instansi Tujuan</th>
                    <th class="text-center">Tanggal Berangkat</th>
                    <th class="text-center">Jumlah Pergi</th>
                    <th class="text-center">No Surat Tugas</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($suratTugas as $surat)
                    <tr class="align-middle">
                        <td class="mt-5">{{ ++$i }}</td>
                        <td>{{ $surat->tempat }}</td>
                        <td class="text-center">{{ $surat->tanggal_berangkat }}</td>
                        <td class="text-center">{{ $surat->anggotas->count() }}</td>
                        <td class="text-center">{{ $surat->no_surat_tugas }}</td>
                        <td class="text-center">
                            <a title="Print Surat Tugas" class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('perjalanan.print', $surat->id) }}">
                                <i class="icon fas fa-print"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">No Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div>
                    {{ $suratTugas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
