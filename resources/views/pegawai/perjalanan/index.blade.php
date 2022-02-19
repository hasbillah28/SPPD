@extends('layouts.app')

@section('style')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')
    @foreach($sppd as $cekbukti)
        @if($cekbukti->perjalanan->status == config('central.status.9'))
                @if($cekbukti->kwitansi->status === '01')
                    <div class="col-sm-12 ">
                        <div class="alert alert-dark text-danger">
                            {{ 'Masukkan bukti Perjalanan dinas yang benar' }}
                        </div>
                    </div>
                @endif
            @endif
    @endforeach
    @if($errors->any())
        <div class="col-sm-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

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
                Daftar Perjalanan
            </div>
            <div class="btn-toolbar d-none d-md-block">
                <a class="btn" href="{{ route('perjalanan.create') }}"><i class="icon cil-plus"></i> Ajukan Perjalanan </a>
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
                    <th class="">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($sppd as $perjalananUser)
                        <tr class="align-middle">
                            <td class="mt-5">{{ ++$i }}</td>
                            <td>{{ $perjalananUser->perjalanan->tempat }}</td>
                            <td class="text-center">{{ $perjalananUser->perjalanan->tanggal_berangkat }}</td>
                            <td class="text-center">{{ $perjalananUser->perjalanan->anggotas->count() }}</td>
                            <td class="text-center">
                                @if ($perjalananUser->perjalanan->status == config('central.status.1'))
                                    <span class="badge me-1 rounded-pill bg-warning">Diajukan</span>
                                @elseif ($perjalananUser->perjalanan->status == config('central.status.9'))
                                        @if($perjalananUser->kwitansi->status == '00')
                                            <span class="badge me-1 rounded-pill bg-info">Perjalanan Aktif</span>
                                        @elseif($perjalananUser->kwitansi->status === '01')
                                            <span class="badge me-1 rounded-pill bg-danger">Tolak</span>
                                        @elseif($perjalananUser->kwitansi->status == '1')
                                            <span class="badge me-1 rounded-pill bg-success">Kuitansi Disetujui</span>
                                        @endif
                                @elseif ($perjalananUser->perjalanan->status == config('central.status.0'))
                                    <span class="badge me-1 rounded-pill bg-primary">Selesai</span>
                                @elseif ($perjalananUser->perjalanan->status == config('central.status.01'))
                                    <span class="badge me-1 rounded-pill bg-warning">Belum Diajukan</span>
                                @elseif ($perjalananUser->perjalanan->status == config('central.status.02'))
                                    <span class="badge me-1 rounded-pill bg-danger">Ditolak</span>
                                @else
                                    <span class="badge me-1 rounded-pill bg-danger">Proses Persetujuan</span>
                                @endif
                            </td>
                            <td class="">
                                <div class="row">
                                @if($perjalananUser->perjalanan->status === config('central.status.01'))
                                    <div class="col-auto p-1">
                                        <form method="post" action="{{ route('perjalanan.destroy', $perjalananUser->perjalanan->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Anda yakin ingin menghapus?')" title="Delete" class="btn btn-danger btn-sm text-white" type="submit"><i class="icon cil-trash"></i> </button>
                                        </form>
                                    </div>
                                @endif
                                    <div class="col-auto p-1">
                                        <a class="btn btn-success btn-sm text-white" href="{{ route('pegawai.perjalanan.show', $perjalananUser->perjalanan->id) }}">
                                            <i class="icon fas fa-eye"></i></a>
                                    </div>

                                    @if($perjalananUser->perjalanan->status != config('central.status.01') || $perjalananUser->perjalanan->status != config('central.status.02') || $perjalananUser->perjalanan->status != config('central.status.1') || $perjalananUser->perjalanan->status != config('central.status.2'))
                                        <div class="col-auto p-1">
                                            <a  class="btn btn-info btn-sm text-white disabled">
                                                <i class="icon fas fa-print"></i></a>
                                        </div>
                                        @if($perjalananUser->perjalanan->status == config('central.status.9'))
                                            @if($perjalananUser->kwitansi->status === '00' || $perjalananUser->kwitansi->status == '01')
                                                @include('pegawai.perjalanan.upload')
                                            <div class="col-auto p-1">
                                                <a title="Upload Bukti SPPD" data-coreui-toggle="modal" data-coreui-target="#modalUpload"  class="btn btn-success btn-sm text-white">
                                                    <i class="icon fas fa-check"></i>
                                                </a>
                                            </div>

                                            @endif
                                        @endif
                                    @else
                                        <div class="col-auto">
                                            <a title="Print Surat Tugas" class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('perjalanan.print', $perjalananUser->perjalanan->id) }}">
                                                <i class="icon fas fa-print"></i></a>
                                        </div>
                                    @endif
                                </div>
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
                    {{ $sppd->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

{{--

@section('script')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>

        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            server: {
                url: '/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });


    </script>
@endsection
--}}
