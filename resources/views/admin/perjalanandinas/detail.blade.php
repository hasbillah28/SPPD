@extends('layouts.app')

@section('content')
    <div class="col-sm-12">
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
        @if($perjalanan->status == config('central.status.6'))
            <div class="alert alert-info">
                {{ $perjalanan->komentar }}
            </div>
            @endif
            @if($perjalanan->status == config('central.status.02'))
                <div class="alert alert-danger">
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
                            @if($perjalanan->status == config('central.status.1'))
                                <form action="{{ route('status.st.on', $perjalanan->id) }}" method="post">
                                    <div class="row col-auto">
                                        <div class="col-auto">

                                            @method('PATCH')
                                            @csrf

                                            <button class="btn form-control" type="submit"><i class="icon icon-lg far fa-check-square"></i> Verifikasi</button>

                                        </div>

                                        <div class="col-auto">
                                            <a href="{{ route('perjalanan.edit', $perjalanan->id) }}" class="btn form-control"><i class="icon icon-lg fas fa-edit"></i> Ubah Detail</a>
                                        </div>
                                    </div>
                                </form>
                            @endif

                            <div class="col-auto">
                                @if($perjalanan->status == config('central.status.3'))
                                    <form action="{{ route('status.spd.on', $perjalanan->id) }}" method="post">
                                        <div class="row">
                                        @method('PATCH')
                                        @csrf
                                            <div class="col-auto">
                                        <button class="btn form-control" type="submit"><i class="icon icon-lg far fa-check-square"></i> Ajukan SPPD</button></div>
                                        <div class="col-auto">
                                            <a href="{{ route('perjalanan.edit', $perjalanan->id) }}" class="btn form-control"><i class="icon icon-lg fas fa-edit"></i> Ubah Detail</a>
                                        </div>
                                        </div>
                                    </form>
                                @endif

                                @if($perjalanan->status == config('central.status.6'))
                                        <form action="{{ route('status.spd.on', $perjalanan->id) }}" method="post">
                                            <div class="row">
                                                @method('PATCH')
                                                @csrf
                                                <div class="col-auto">
                                                    <a href="{{ route('perjalanan.edit', $perjalanan->id) }}" class="btn form-control"><i class="icon icon-lg fas fa-edit"></i> Ubah Detail</a>
                                                </div>

                                                <div class="col-auto">
                                                    <button class="btn form-control" type="submit"><i class="icon icon-lg far fa-check-square"></i> Selesai Perbaiki</button>
                                                </div>
                                            </div>
                                        </form>
                                @endif

                                @if($perjalanan->status == config('central.status.8'))
                                        <form action="{{ route('status.spd.acc.complete', $perjalanan->id) }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <button class="btn form-control" type="submit"><i class="icon icon-lg far fa-check-square"></i> Selesai Tanda Tangan</button>
                                        </form>
                                    @endif
                            </div>
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
                    <a href="{{ route('perjalanan.index') }}" class="btn btn-sm btn-dark align-middle"><i class="icon icon-lg fas fa-caret-left"></i> Back To Home</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                {{-- Pengikut --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header d-flex justify-content-between">
                            <div class="card-title mt-2">Anggota Pengikut</div> </div>
                        <div class="card-body">
                            {{-- Open form to add pegawai --}}
                            @if($perjalanan->status == config('central.status.1') ||$perjalanan->status == config('central.status.3') || $perjalanan->status == config('central.status.6'))
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
                                            <button type="submit" title="Add" class="btn btn-primary form-control">Tambah</button>
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
                                            <form method="post" action="{{ route('perjalanan.anggota.destroy', [$anggota->perjalanan->id, $anggota->user->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                @if ($perjalanan->status == config('central.status.8') || $perjalanan->status == config('central.status.0') || $perjalanan->status == config('central.status.9'))
                                                    <a class="btn btn-info btn-sm text-white" target="_blank" href="{{ route('perjalanan.anggota.print', [$anggota->perjalanan->id, $anggota->user->id]) }}">
                                                        <i class="icon fas fa-print" title="Print"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-info btn-sm text-white disabled" href="{{ route('perjalanan.anggota.print', [$anggota->perjalanan->id, $anggota->user->id]) }}">
                                                        <i class="icon fas fa-print" ></i>
                                                    </a>


                                                    @if($perjalanan->status == config('central.status.3') || $perjalanan->status == config('central.status.6') || $perjalanan->status == config('central.status.1'))
                                                    <button type="submit" class="btn btn-sm btn-danger text-white">
                                                        <i class="icon cil-trash" title="Delete"></i>
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
                <div class="col-12 mt-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mt-2">Riwayat Disposisi Perjalanan</div>
                            @if($perjalanan->status == config('central.status.3') || $perjalanan->status == config('central.status.6'))
                                <div class="btn-toolbar d-none d-md-block">
                                    <a class="btn" href="{{ route('perjalanan.riwayat.create', $perjalanan->id) }}"><i class="icon fas fa-plus-circle"></i> Tambah Riwayat</a>
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @php
                                $i = 0
                                @endphp

                                @forelse($perjalanan->riwayat as $riwayat)

                                    <div class="col-auto mb-1">
                                        <div class="card">
                                            <div class="card-header bg-white d-flex justify-content-between">
                                                <div class="card-title mt-2">
                                                    Riwayat Perjalanan #{{ ++$i }}
                                                </div>
                                                @if($perjalanan->status == config('central.status.3') || $perjalanan->status ==  config('central.status.6'))
                                                    <div class="btn-toolbar d-none d-md-block">
                                                        <form method="post" action="{{ route('perjalanan.riwayat.destroy', [$riwayat->perjalanan->id, $riwayat->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger text-white"><i class="icon-sm fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                @endif
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
                                @empty
                                    <div class="text-center">
                                        <em>Belum Ada Riwayat Perjalanan</em>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
