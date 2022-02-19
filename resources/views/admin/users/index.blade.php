@extends('layouts.app')

@section('content')
@php
    $i = 0
@endphp
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
  </div>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="card-title mt-2">
            Daftar User
        </div>
        <div class="btn-toolbar d-none d-md-block">
            <a class="btn" href="{{ route('user.create') }}"><i class="icon cil-plus"></i> Tambah User </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Users</th>
                    <th>Jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->nip }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->jabatan->nama_jabatan }}</td>
                        <td>
                            <form method="post" onsubmit="return confirm('Anda yakin ingin menghapus?')" action="{{ route('user.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <a title="History" class="btn btn-info text-white btn-sm" href="{{ route('user.riwayat', $user->id) }}"><i class="icon fas fa-history"></i></a>
                                <a title="Edit" class="btn btn-info text-white btn-sm" id="edit" href="{{ route('user.edit', $user->id) }}" type="button"><i class="icon cil-pencil"></i></a>
                                <button title="Hapus"  class="text-white btn btn-danger btn-sm" type="submit"><i class="icon cil-trash"></i> </button>
                                <a title="Show" class="btn btn-success btn-sm text-white    " id="show" href="{{route('user.show', $user->id)}}"><i class="icon fas fa-eye"></i></a>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3">No Data</td>
                        </tr>
                    @endforelse



            </tbody>
        </table>
    </div>
</div>
@endsection
