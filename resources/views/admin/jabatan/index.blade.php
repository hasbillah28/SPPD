@extends('layouts.app')

@section('content')
@include('admin.jabatan.create')
@include('admin.jabatan.edit')
@php
    $i = 0
@endphp
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
        @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
  </div>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="card-title mt-2">
            Daftar Jabatan
        </div>
        <div class="btn-toolbar d-none d-md-block">
            <a class="btn" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" href="{{ route('jabatan.create') }}"><i class="icon cil-plus"></i> Tambah Jabatan </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped-border table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($jabatans[0]->id != null)
                    @foreach ($jabatans as $jabatan)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $jabatan->nama_jabatan }}</td>
                        <td>
                            <form method="post" onsubmit="return confirm('Anda yakin ingin menghapus?')" action="{{ route('jabatan.destroy', $jabatan->id) }}">
                                @csrf
                                @method('DELETE')
                                <button title="Edit" class="btn btn-info btn-sm text-white" data-coreui-toggle="modal" data-coreui-target="#editStaticModal"  id="edit" data-coreui-editId="{{ $jabatan->id }}" data-coreui-namaJabatan="{{ $jabatan->nama_jabatan }}" type="button" ><i class="icon cil-pencil"></i></button>
                                <button title="Hapus"  class="btn btn-danger btn-sm text-white" type="submit"><i class="icon cil-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No Data</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
<script>
    const editModal = document.getElementById('editStaticModal')
    editModal.addEventListener('show.coreui.modal', function (event) {
        var button = event.relatedTarget

        var id = button.getAttribute('data-coreui-editId')
        var name = button.getAttribute('data-coreui-namaJabatan')

        var modalTitle = editModal.querySelector('.modal-title')
        var inputName = editModal.querySelector('#editNamaJabatan')
        var inputId = editModal.querySelector('#idJabatan')

        inputName.value = name
        inputId.value = id

        modalTitle.textContent = 'Edit Nama Jabatan ' + name

    })
</script>
@endsection
