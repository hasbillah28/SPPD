@extends('layouts.app')

@section('content')
@include('admin.golongan.create')
@include('admin.golongan.edit')
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
            Daftar Golongan
        </div>
        <div class="btn-toolbar d-none d-md-block">
            <a class="btn" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" href="{{ route('golongan.create') }}"><i class="icon cil-plus"></i> Tambah Golongan </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped-border table-responsive-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Golongan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($golongans[0]->id != null)
                    @foreach ($golongans as $golongan)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $golongan->nama_golongan }}</td>
                        <td>
                            <form method="post" onsubmit="return confirm('Anda yakin ingin menghapus?')" action="{{ route('golongan.destroy', $golongan->id) }}">
                                @csrf
                                @method('DELETE')
                                <button title="Edit" class="btn btn-info btn-sm text-white" data-coreui-toggle="modal" data-coreui-target="#editStaticModal"  id="edit" data-coreui-id="{{ $golongan->id }}" data-coreui-nama="{{ $golongan->nama_golongan }}" type="button"><i class="icon cil-pencil"></i></button>
                                <button title="Hapus"  class="btn btn-danger btn-sm text-white" type="submit"><i class="icon cil-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No Data</td>
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
        var inputName = editModal.querySelector('#editNamaGolongan')
        var inputId = editModal.querySelector('#idGolongan')

        inputName.value = name
        inputId.value = id

        modalTitle.textContent = 'Edit Nama Golongan ' + name

    })
</script>
@endsection
