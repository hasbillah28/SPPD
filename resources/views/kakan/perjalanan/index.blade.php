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
                Daftar Perjalanan Meminta Persetujuan
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
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($perjalanans as $perjalanan)
                        <tr class="align-middle">
                            <td class="mt-5">{{ ++$i }}</td>
                            <td>{{ $perjalanan->tempat }}</td>
                            <td class="text-center">{{ $perjalanan->tanggal_berangkat }}</td>
                            <td class="text-center">{{ $perjalanan->anggotas->count() }}</td>
                            <td class="text-center">
                                @if ($perjalanan->status == config('central.status.2'))
                                    <span class="badge me-1 rounded-pill bg-warning">Meminta Persetujuan Surat Tugas</span>
                                @elseif ($perjalanan->status == config('central.status.7'))
                                    <span class="badge me-1 rounded-pill bg-warning">Meminta Persetujuan SPPD</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm text-white" target="_blank" title="Lihat Surat Tugas" href="{{ route('perjalanan.print', $perjalanan->id) }}">
                                    <i class="icon fas fa-print"></i></a>

                                <a class="btn btn-info btn-sm text-white" href="{{ route('kakan.persetujuan.show', $perjalanan->id) }}">
                                    <i class="icon fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="p-2 text-sm-center">
                                    <em>Tidak ada yang meminta persetujuan</em>
                                </div>

                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="row">
                <div>
                    {{ $perjalanans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
