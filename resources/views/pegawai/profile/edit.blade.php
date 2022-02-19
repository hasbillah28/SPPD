<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-auto align-middle">
                <h5 class="card-title mt-1">User Profile Data</h5>
            </div>
            <div class="row col-auto">
                <a id="editButton" href="{{ route('profile.edit') }}" class="btn">
                    <div class="row">
                        <div class="col-auto">
                            <i class="icon icon-lg fas fa-user-cog"></i>
                        </div>
                        <div id="editName" class="col-auto">
                            Change Personal Data
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="row mt-2 mb-2">
                <label for="name" class="col-4 col-form-label">Nama</label>
                <div class="col-8">
                    <input type="text"  name="name" class="form-control" id="name" value="{{ $user->name }}">
                </div>
            </div>

            <div class="row mb-2">
                <label for="nip" class="col-4 col-form-label">NIP</label>
                <div class="col-8">
                    <input type="text"  name="nip"  class="form-control" id="nip" value="{{ $user->nip }}">
                </div>
            </div>

            <div class="row mb-2">
                <label for="nip" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email"  name="email"  class="form-control" id="email" value="{{ $user->email }}">
                </div>
            </div>

            <div class="row mb-2">
                <label for="noHp" class="col-4 col-form-label">No Handphone</label>
                <div class="col-8">
                    <input type="text"  name="noHp"  class="form-control-plaintext" id="noHp" value="{{ $user->no_hp }}">
                </div>
            </div>

            <div class="row mb-2">
                <label for="nip" class="col-4 col-form-label">Jabatan</label>
                <div class="col-8">
                    <input type="text" disabled readonly class="form-control disabled" id="nip" value="{{ $user->jabatan->nama_jabatan }}">
                </div>
            </div>

            <div class="row mb-2">
                <label for="nip" class="col-4 col-form-label">Pangkat / Golongan</label>
                <div class="col-8">
                    <input type="text" readonly class="form-control disabled" disabled id="nip" value="{{ $user->pangkat->nama_pangkat.'/'.$user->golongan->nama_golongan }}">
                </div>
            </div>

            <div class="row mb-2">
                <label for="nip" class="col-4 col-form-label">Role</label>
                <div class="col-8">
                    <input type="text" readonly class="form-control disabled" disabled id="nip" value="">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-auto">
                    <button type="submit" class="btn btn-info text-white">Save personal data</button>
                </div>
            </div>
        </div>
    </div>

</div>
