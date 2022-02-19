@extends('layouts.app')

@section('content')
    @include('pegawai.profile.ava')

    <div class="container">
        <div class="col-sm-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="col-sm-12">
            @if(session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        @if($errors->any())
            <div class="col-sm-12">
                <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                </div>
            </div>
        @endif
        <div class="row">
            <div id="isian" class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-auto align-middle">
                                <h5 class="card-title mt-1">User Profile Data</h5>
                            </div>
                            <div class="row col-auto">
                                <button id="editButton" href="" class="btn">
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="icon icon-lg fas fa-user-cog"></i>
                                        </div>
                                        <div id="editName" class="col-auto">
                                            Change Personal Data
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <form id="form" action="" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="row mt-2 mb-2">
                                    <label for="name" class="col-4 col-form-label">Nama</label>
                                    <div class="col-8">
                                        <input type="text" name="name"  readonly class="form-control-plaintext" id="name" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">NIP</label>
                                    <div class="col-8">
                                        <input type="text" name="nip"  readonly class="form-control-plaintext" id="nip" value="{{ $user->nip }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="nip" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input type="email" name="email"  readonly class="form-control-plaintext" id="email" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="noHp" class="col-4 col-form-label">No Handphone</label>
                                    <div class="col-8">
                                        <input type="text" name="noHp"  readonly class="form-control-plaintext" id="noHp" value="{{ $user->no_hp }}">
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
                        </form>

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
                                        @if(Auth::user()->avatar != null)
                                            <img class="img-fluid" style="border-radius: 50%" src="{{ asset('storage/file/'.Auth::user()->id.'/avatar/'.Auth::user()->avatar) }}" alt="Foto User">
                                        @else
                                            <img class="img-fluid" width="200" height="200" src="{{ asset('storage/defaultava.png') }}" alt="">
                                        @endif
                                    </a>
                                </div>

                                <div class="col-auto text-center mt-3 mb-3">
                                    @if(Auth::user()->avatar != null)
                                        <form action="{{ route('profile.ava.remove', Auth::user()->id) }}" method="post">
                                            @csrf
                                            @method('patch')

                                            <button class="btn btn-danger text-white">Hapus Avatar</button>
                                            <a href="" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" class="btn btn-info text-white">Ganti Avatar</a>
                                        </form>

                                    @else
                                        <a href="" data-coreui-toggle="modal" data-coreui-target="#staticBackdropLive" class="btn btn-info text-white">Ganti Avatar</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title"><em>Ganti Password</em></h6>
                            <form action="{{ route('profile.password.change') }}" method="post">
                                @csrf
                                @method('patch')
                                <label class="form-label" for="oldPassword">Password Lama</label>
                                <input type="password" class="form-control mb-2 @error("oldpassword") is-invalid @enderror" name="oldPassword" id="oldPassword">

                                <label class="form-label" for="newPassword">Password Baru</label>
                                <input type="password" class="form-control mb-3 @error("newpassword") is-invalid @enderror" name="newPassword" id="newPassword">

                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <button class="btn btn-info text-white" type="submit">Ganti Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('editButton').addEventListener("click", function () {
            document.getElementById('editButton').hidden = true

            const input = document.querySelectorAll('.form-control-plaintext')

            document.getElementById('form').setAttribute("action", '{{ route('profile.update') }}')

            input.forEach(element => {
                element.classList.replace('form-control-plaintext', 'form-control')
                element.removeAttribute('readonly')
            })

            document.getElementById('buttonSave').removeAttribute('hidden')
        })
    </script>
@endsection
