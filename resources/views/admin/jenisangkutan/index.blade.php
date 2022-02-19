@extends('layouts.app')

@section('content')
@include('admin.jenisangkutan.create')
@include('admin.jenisangkutan.edit')
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
            Daftar Jenis Angkutan
        </div>
        <div class="btn-toolbar d-none d-md-block">
            <a class="btn" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" href="{{ route('angkutan.create') }}"><i class="icon cil-plus"></i> Tambah Jenis Angkutan </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jenis Angkutan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($angkutans != null || $angkutans != '')
                    @foreach ($angkutans as $angkutan)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $angkutan->nama_angkutan }}</td>
                        <td>
                            <form method="post" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" action="{{ route('angkutan.destroy', $angkutan->id) }}">
                                @csrf
                                @method('DELETE')
                                <button title="Edit" class="btn btn-info text-white btn-sm" data-coreui-toggle="modal" data-coreui-target="#editStaticModal"  id="edit" data-coreui-id="{{ $angkutan->id }}" data-coreui-nama="{{ $angkutan->nama_angkutan }}" type="button"><i class="icon cil-pencil"></i></button>
                                <button title="Hapus"  class="text-white btn btn-danger btn-sm" type="submit"><i class="icon cil-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No Data</td>
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

        var id = button.getAttribute('data-coreui-id')
        var name = button.getAttribute('data-coreui-nama')

        var modalTitle = editModal.querySelector('.modal-title')
        var inputName = editModal.querySelector('#editNamaJabatan')
        var inputId = editModal.querySelector('#idJabatan')

        inputName.value = name
        inputId.value = id

        modalTitle.textContent = 'Edit Nama Jenis Angkutan ' + name
    })
</script>
@endsection
