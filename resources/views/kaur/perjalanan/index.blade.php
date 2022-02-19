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
                                @if($perjalanan->status == config('central.status.6'))
                                    <span class="badge me-1 rounded-pill bg-info">Sedang Memperbaiki</span>
                                @else
                                    <span class="badge me-1 rounded-pill bg-warning">Meminta Persetujuan Surat Perjalanan Dinas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a title="Menampilkan Detail Perjalanan" class="btn btn-info btn-sm text-white" href="{{ route('kaur.perjalanan.show', $perjalanan->id) }}"><i class="icon fas fa-eye"></i></a>
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
                    {{ $perjalanans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
