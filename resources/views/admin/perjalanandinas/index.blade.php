@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

    <div class="col-sm-12">
        @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mt-2">
                Daftar Perjalanan
            </div>
            <div class="btn-toolbar d-none d-md-block">
                <a class="btn" href="{{ route('perjalanan.create') }}"><i class="icon cil-plus"></i> Tambah Perjalanan </a>
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
                                @if ($perjalanan->status == config('central.status.1'))
                                    <span class="badge me-1 rounded-pill bg-warning">Diajukan Pegawai</span>
                                @elseif ($perjalanan->status == config('central.status.2'))
                                    <span class="badge badge-sm me-1 rounded-pill bg-info">Meminta Persetujuan Kepala Kantor</span>
                                @elseif ($perjalanan->status == config('central.status.3'))
                                    <span class="badge me-1 rounded-pill bg-success">Surat Tugas Disetujui</span>
                                @elseif ($perjalanan->status == config('central.status.4'))
                                    <span class="badge me-1 rounded-pill bg-info">Persetujuan Kaur</span>
                                @elseif ($perjalanan->status == config('central.status.5'))
                                    <span class="badge me-1 rounded-pill bg-info">Persetujuan Kasubag</span>
                                @elseif ($perjalanan->status == config('central.status.6'))
                                    <span class="badge me-1 rounded-pill bg-warning">Perbaiki</span>
                                @elseif ($perjalanan->status == config('central.status.7'))
                                    <span class="badge me-1 rounded-pill bg-info">Persetujuan Kepala</span>
                                @elseif ($perjalanan->status == config('central.status.8'))
                                    <span class="badge me-1 rounded-pill bg-success">Disetujui </span>
                                @elseif ($perjalanan->status == config('central.status.9'))
                                    <span class="badge me-1 rounded-pill bg-info">Perjalanan Aktif</span>
                                @elseif ($perjalanan->status == config('central.status.0'))
                                    <span class="badge me-1 rounded-pill bg-success">Selesai</span>
                                @else
                                    <span class="badge me-1 rounded-pill bg-danger">Batal</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form method="post" onsubmit="return confirm('Anda yakin ingin menghapus?')" action="{{ route('perjalanan.destroy', $perjalanan->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-success btn-sm text-white" href="{{ route('perjalanan.show', $perjalanan->id) }}">
                                        <i class="icon fas fa-eye" title="Detail"></i></a>
                                    @if($perjalanan->status == config('central.status.8') || $perjalanan->status == config('central.status.9') || $perjalanan->status == config('central.status.0'))
                                    <a class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('perjalanan.print', $perjalanan->id) }}">
                                        <i class="icon fas fa-print" title="Print"></i></a>
                                    @else
                                    <a class="btn btn-info btn-sm text-white disabled">
                                        <i class="icon fas fa-print"></i></a>
                                    @endif
                                    <button  class="btn btn-danger btn-sm text-white" title="Delete" type="submit"><i class="icon cil-trash"></i> </button>
                                </form>
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
                    {{ $perjalanans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
