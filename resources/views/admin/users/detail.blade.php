@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div id="isian" class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-auto align-middle">
                                <h5 class="card-title mt-1">User Profile </h5>
                            </div>
                            <div class="row col-auto">
                                <button id="editButton" href="" class="btn">
                                    <div class="row">

                                    </div>
                                </button>
                            </div>
                        </div>
                            <div class="row">
                                <div class="row mt-2 mb-2">
                                    <label for="name" class="col-4 col-form-label">Nama</label>
                                    <div class="col-8">
                                        <input type="text" name="name" required readonly class="form-control-plaintext" id="name" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">NIP</label>
                                    <div class="col-8">
                                        <input type="text" name="nip" required readonly class="form-control-plaintext" id="nip" value="{{ $user->nip }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input type="email" name="email" required readonly class="form-control-plaintext" id="email" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="noHp" class="col-4 col-form-label">No Handphone</label>
                                    <div class="col-8">
                                        <input type="text" name="noHp" required readonly class="form-control-plaintext" id="noHp" value="{{ $user->no_hp }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">Jabatan</label>
                                    <div class="col-8">
                                        <input type="text" disabled readonly class="form-control-plaintext" id="nip" value="{{ $user->jabatan->nama_jabatan }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">Pangkat / Golongan</label>
                                    <div class="col-8">
                                        <input type="text" readonly class="form-control-plaintext" disabled id="nip" value="{{ $user->pangkat->nama_pangkat.'/'.$user->golongan->nama_golongan }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">Role</label>
                                    <div class="col-8">
                                        <input type="text" readonly class="form-control-plaintext" disabled id="nip" value="">
                                    </div>
                                </div>

                                <div class="row mb-2" hidden id="buttonSave">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-info text-white">Save personal data</button>
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="row mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title"><em>User's Avatar</em></h6>
                            <div class="row justify-content-center">
                                <div class="col-12 text-center" style="border-radius: 50%">
                                    <a>
                                        @if($user->avatar != null)
                                            <img class="img-fluid" style="border-radius: 50%" src="{{ asset('storage/file/'.Auth::user()->id.'/avatar/'.$user->avatar) }}" alt="Foto User">
                                        @else
                                            <img class="img-fluid" width="200" height="200" src="{{ asset('storage/defaultava.png') }}" alt="">
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection


