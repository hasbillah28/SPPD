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
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">{{ __('Edit Data User') }}</div>

                    <div class="card-body">
                        <form method="POST"  action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="input-group mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('NIP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $user->nip }}"  autocomplete="nip" autofocus>

                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="jabatan" class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan" >
                                        <option selected value="">Pilih Jabatan</option>
                                        @foreach ($jabatans as $jabatan)
                                            @if($user->jabatan->id == $jabatan->id)
                                                <option selected value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                            @else
                                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="pangkat" class="col-md-4 col-form-label text-md-right">{{ __('Pangkat') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('pangkat') is-invalid @enderror" name="pangkat" id="pangkat" >
                                        <option selected value="">Pilih Pangkat</option>
                                        @foreach ($pangkats as $pangkat)
                                            @if($user->pangkat->id == $pangkat->id)
                                                <option selected value="{{ $pangkat->id }}">{{ $pangkat->nama_pangkat }}</option>
                                            @else
                                                <option value="{{ $pangkat->id }}">{{ $pangkat->nama_pangkat }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('pangkat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="golongan" class="col-md-4 col-form-label text-md-right">{{ __('Golongan') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('golongan') is-invalid @enderror" name="golongan" id="golongan" >
                                        <option selected value="">Pilih Golongan</option>
                                        @foreach ($golongans as $golongan)
                                            @if($user->golongan->id == $golongan->id)
                                                <option selected value="{{ $golongan->id }}">{{ $golongan->nama_golongan }}</option>
                                            @else
                                                <option value="{{ $golongan->id }}">{{ $golongan->nama_golongan }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('golongan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="no_hp" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                                <div class="col-md-6">
                                    <input id="no_hp" type="text" maxlength="15" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $user->no_hp }}"  autocomplete="no_hp">

                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="no_hp" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">

                                    @foreach($roles as $role)
                                        <div class="form-check form-check-inline">
                                            @empty($userRoles)
                                                <input name="roles[]" type="checkbox" class="form-check-input" id="role{{ $role->id }}" value="{{ $role->name }}">
                                                <label for="role{{ $role->id }}" class="form-check-label">
                                                    @if($role->name== 'kakan')
                                                        {{ 'Kepala Kantor' }}
                                                    @elseif($role->name== 'ppk')
                                                        {{ 'Pejabat Pembuat Komitmen' }}
                                                    @else
                                                        {{ $role->name }}
                                                    @endif
                                                </label>

                                            @else

                                                @if(collect($userRoles)->contains($role->name))
                                                    <input name="roles[]" type="checkbox" checked class="form-check-input" id="role{{ $role->id }}" value="{{ $role->name }}">
                                                    <label for="role{{ $role->id }}" class="form-check-label">
                                                        @if($role->name== 'kakan')
                                                            {{ 'Kepala Kantor' }}
                                                        @elseif($role->name== 'ppk')
                                                            {{ 'Pejabat Pembuat Komitmen' }}
                                                        @else
                                                            {{ $role->name }}
                                                        @endif
                                                    </label>
                                                @else
                                                    <input name="roles[]" type="checkbox" class="form-check-input" id="role{{ $role->id }}" value="{{ $role->name }}">
                                                    <label for="role{{ $role->id }}" class="form-check-label">
                                                        @if($role->name== 'kakan')
                                                            {{ 'Kepala Kantor' }}
                                                        @elseif($role->name== 'ppk')
                                                            {{ 'Pejabat Pembuat Komitmen' }}
                                                        @else
                                                            {{ $role->name }}
                                                        @endif
                                                    </label>
                                                @endif
                                            @endempty
                                        </div>
                                    @endforeach

                                </div>
                            </div>

{{--                             <div class="input-group mb-3">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                    @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
