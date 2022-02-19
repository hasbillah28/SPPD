@extends('layouts.app')

@section('content')
@include('admin.pangkat.create')
@include('admin.pangkat.edit')
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
<div class="container">
<div class="row justify-content-center">
    <div class="">
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="card-title mt-2">
            Daftar Pangkat
        </div>
        <div class="btn-toolbar d-none d-md-block">
            <a class="btn" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" href="{{ route('pangkat.create') }}"><i class="icon cil-plus"></i> Tambah Pangkat </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-responsive-sm ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pangkat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($pangkats[0]->id != null)
                    @foreach ($pangkats as $pangkat)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $pangkat->nama_pangkat }}</td>
                        <td>
                            <form method="post" onsubmit="return confirm('Anda yakin ingin menghapus?')" action="{{ route('pangkat.destroy', $pangkat->id) }}">
                                @csrf
                                @method('DELETE')
                                <button title="Edit" class="btn btn-info text-white text-white btn-sm" data-coreui-toggle="modal" data-coreui-target="#editStaticModal"  id="edit" data-coreui-id="{{ $pangkat->id }}" data-coreui-nama="{{ $pangkat->nama_pangkat }}" type="button" ><i class="icon cil-pencil"></i></button>
                                <button title="Hapus"  class="text-white btn btn-danger text-white btn-sm" type="submit"><i class="icon cil-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No Data</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
    </div>
        </div>
</div>
<script>
    const editModal = document.getElementById('editStaticModal')
    editModal.addEventListener('show.coreui.modal', function (event) {
        var button = event.relatedTarget

        var id = button.getAttribute('data-coreui-id')
        var name = button.getAttribute('data-coreui-nama')

        var modalTitle = editModal.querySelector('.modal-title')
        var inputName = editModal.querySelector('#editNamaPangkat')
        var inputId = editModal.querySelector('#idPangkat')

        inputName.value = name
        inputId.value = id

        modalTitle.textContent = 'Edit Pangkat ' + name
    })
</script>
@endsection
