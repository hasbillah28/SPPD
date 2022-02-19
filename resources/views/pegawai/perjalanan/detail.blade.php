@extends('layouts.app')

@section('content')
    <div class="col-sm-12 ">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            @if($perjalanan->status == config('central.status.02'))
                <div class="alert alert-dark text-danger">
                    {{ $perjalanan->komentar }}
                </div>
            @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mt-2">
                        Detail Perjalanan
                    </div>
                    <div class="btn-toolbar d-none d-md-block">
                        <div class="row">
                            @if($perjalanan->status == config('central.status.01'))
                                <div class="col-auto">
                                    <form action="{{ route('status.st.sub', $perjalanan->id) }}" method="post">
                                        @method('PATCH')
                                        @csrf
                                        <button class="btn form-control" type="submit"><i class="icon icon-lg far fa-check-square"></i> Selesai dan Ajukan</button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('pegawai.perjalanan.edit', $perjalanan->id) }}" class="btn form-control"><i class="icon icon-lg fas fa-edit"></i> Ubah Detail</a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="card-body">

                    @if($perjalanan->no_surat_tugas != null)
                        <div class="col-4"><strong>Nomor Surat Tugas</strong></div>
                        <div class="col-8 mb-2">{{ $perjalanan->no_surat_tugas }}</strong></div>
                    @endif

                    <div class="col-4"><strong>Tujuan Instansi</strong></div>
                    <div class="col-8 mb-2">{{ $perjalanan->tempat }}</strong></div>

                    <div class="col-4"><strong>Deskripsi</strong></div>
                    <div class="col-auto mb-3">{{ $perjalanan->deskripsi }}</div>

                    <div class="row">
                        <div class="col-6"><strong>Tempat Tujuan</strong></div>
                        <div class="col-6"><strong>Tempat Berangkat</strong></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">{{ $perjalanan->tempat_tujuan }}</div>
                        <div class="col-6">{{ $perjalanan->tempat_berangkat }}</div>
                    </div>

                    <div class="row">
                        <div class="col-6"><strong>Tanggal Berangkat</strong></div>
                        <div class="col-6"><strong>Tangggal Kembali</strong></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">{{ $perjalanan->tanggal_berangkat }}</div>
                        <div class="col-6">{{ $perjalanan->tanggal_kembali }}</div>
                    </div>

                    <div class="col-4"><strong>Jenis Angkutan</strong></div>
                    <div class="col-6">{{ $perjalanan->angkutan->nama_angkutan }}</div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('pegawai.perjalanan') }}" class="btn btn-sm btn-dark align-middle"><i class="icon icon-lg fas fa-caret-left"></i> Back To Home</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                {{-- Pengikut --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header d-flex justify-content-between">
                            <div class="card-title mt-2">Pegawai Mengikuti Perjlanan</div> </div>
                        <div class="card-body">
                            {{-- Open form to add pegawai --}}
                            @if($perjalanan->status == config('central.status.01'))
                                <form action="{{ route('perjalanan.anggota.store', $perjalanan->id) }}" method="post">
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            @csrf
                                            <select name="user_id" class="form-select" required>
                                                <option value="" disabled selected>Pilih Pegawai Pergi</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="submit" class="btn btn-primary form-control">Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            @endif


                            {{-- table for anggota perjalanan --}}
                            <table class="table">
                                <thead class="align-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 0
                                @endphp
                                @forelse ($perjalanan->anggotas as $anggota)
                                    <tr class="align-middle">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $anggota->user->name }}</td>
                                        <td class="text-center">
                                            <form method="post" action="{{ route('pegawai.perjalanan.anggota.destroy', [$anggota->perjalanan->id, $anggota->user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                @if ($perjalanan->status == config('central.status.8') || $perjalanan->status == config('central.status.0') || $perjalanan->status == config('central.status.9'))
                                                    <a class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('perjalanan.anggota.print', [$anggota->perjalanan->id, $anggota->user->id]) }}">
                                                        <i class="icon fas fa-print"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-info btn-sm text-white disabled" href="{{ route('perjalanan.anggota.print', [$anggota->perjalanan->id, $anggota->user->id]) }}">
                                                        <i class="icon fas fa-print"></i>
                                                    </a>


                                                    @if($perjalanan->status === config('central.status.01'))
                                                        <button type="submit" class="btn btn-sm btn-danger text-white">
                                                            <i class="icon cil-trash"></i>
                                                        </button>
                                                    @endif
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-sm-center"><em>Belum Ada Pegawai yang ditugaskan</em></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Detail Jalan perjalanan dinas (hal 2 sppd) --}}
                @if($perjalanan->status == config('central.status.9'))
                <div class="col-12 mt-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mt-2">Riwayat Perjalanan</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @php
                                $i = 0
                                @endphp

                                @foreach($perjalanan->riwayat as $riwayat)

                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header bg-white d-flex justify-content-between">
                                                <div class="card-title mt-2">
                                                    Riwayat Perjalanan #{{ ++$i }}
                                                </div>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-6">
                                                    <dl class="row">
                                                        <dt class="col-4">Tiba di</dt>
                                                        <dd class="col-8">{{ $riwayat->tiba_di }}</dd>
                                                        <dt class="col-4">Tanggal</dt>
                                                        <dd class="col-8">{{ $riwayat->tiba_di_tanggal }}</dd>
                                                    </dl>
                                                </div>

                                                <div class="col-6">
                                                    <dl class="row">
                                                        <dt class="col-6">Berangkat ke</dt>
                                                        <dd class="col-6">{{ $riwayat->berangkat_ke }}</dd>
                                                        <dt class="col-6">Tanggal</dt>
                                                        <dd class="col-6">{{ $riwayat->berangkat_tanggal }}</dd>
                                                    </dl>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
@endsection
