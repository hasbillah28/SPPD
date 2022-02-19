<?php

namespace Database\Seeders;

use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\JenisAngkutan;
use App\Models\Pangkat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $id=substr(md5(mt_rand()), 0, 6);

        $jabatan=Jabatan::create([
            'nama_jabatan'=>'admin',
            'id'=>'JBT_'.$id
        ]);

        $golongan=Golongan::create([
            'nama_golongan'=>'admin',
            'id'=>'GL_'.$id

        ]);

        $pangkat=Pangkat::create([
            'nama_pangkat'=>'admin',
            'id'=>'PKT_'.$id
        ]);

        $jenis_angkutan=JenisAngkutan::create([
            'nama_angkutan'=>'Kendaraan Umum',
            'id'=>'JA_'.$id
        ]);

        $roleAdmin =Role::create([
            'name'=>'admin'
        ]);

        $roleKakan = Role::create([
            'name'=>'kakan'
        ]);

        $pegawai = Role::create([
            'name'=>'pegawai'
        ]);

        $roleKaur = Role::create([
            'name'=>'kaur'
        ]);

        $roleKasubag = Role::create([
            'name'=>'kasubag'
        ]);

        Role::create([
            'name'=>'bendahara'
        ]);

        Role::create([
            'name'=>'ppk'
        ]);

        $admin = User::create([
            'id'=>'admin',
            'name'=>'admin',
            'nip'=>'admin',
            'email'=>'email',
            'password'=>Hash::make('admin'),
            'no_hp'=>'1111',
            'jabatan_id'=>$jabatan->id,
            'pangkat_id'=>$pangkat->id,
            'golongan_id'=>$golongan->id
        ]);


        $admin->assignRole($roleAdmin);

    }

}
