<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{

    public function index() {
        $users = User::OrderBy('created_at')->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit($id) {
        $user = User::find($id);
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        $pangkats = Pangkat::all();
        $roles = Role::all();

        $userRoles = $user->getRoleNames();

        return view('admin.users.edit', compact('user', 'userRoles', 'jabatans', 'golongans', 'pangkats', 'roles'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'nip' => 'required|numeric',
            'email' => 'required|email',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'no_hp'=> 'required|numeric',
            'roles' => 'required'
        ]);
        try {


            $user = User::find($id);
            $currentRole = $user->getRoleNames()->toArray();
            $requestedRole = $request->roles;


            $user->name = $request->name;
            $user->nip = $request->nip;
            $user->no_hp = $request->no_hp;
            $user->email = $request->email;
            $user->jabatan_id = $request->jabatan;
            $user->pangkat_id = $request->pangkat;
            $user->golongan_id = $request->golongan;

            $user->save();

            // periksa role
            if ($currentRole != $requestedRole) {
                $user->syncRoles();
                foreach ($requestedRole as $role) {
                    $return = false;
                    if ($role === 'kakan' || $role === 'kaur' || $role === 'bendahara' || $role === 'kasubag' || $role === 'ppk') {
                        $kakan = User::role('kakan')->get();
                        $kasubag = User::role('kasubag')->get();
                        $kaur = User::role('kaur')->get();
                        $bendahara = User::role('bendahara')->get();
                        $ppk = User::role('ppk')->get();

                        switch ($role) {
                            case 'kakan':
                                ($kakan->count() == 0) ? $user->assignRole($role) : $return = true;
                                break;

                            case 'kaur':
                                ($kaur->count() == 0) ? $user->assignRole($role) : $return = true;
                                break;

                            case 'kasubag':
                                ($kasubag->count() == 0) ? $user->assignRole($role) : $return = true;
                                break;

                            case 'bendahara':
                                ($bendahara->count() == 0) ? $user->assignRole($role) : $return = true;
                                break;

                            case 'ppk':
                                ($ppk->count() == 0) ? $user->assignRole($role) : $return = true;
                                break;
                        }

                        if ($return) {
                            return redirect()->route('users.index')->with('error', 'tidak bisa menambahkan Kaur Kepala Kantor atau Kasubag lebih dari satu user');
                        }
                    } else {
                        $user->assignRole($role);
                    }
                }
            }

            return redirect()->route('users.index')->with('success', 'User '.$user->name.' data telah diperbarui');
        }catch (QueryException $exception){
            return redirect()->back()->with('error', 'User tidak bisa diperbaharui karena ada kesamaan NIP/Nomor Telfon/Email dengan user yang sudah ada');
        }
    }

    public function create() {
        $jabatans = Jabatan::orderByDesc('nama_jabatan')->get();
        $golongans = Golongan::all();
        $pangkats = Pangkat::all();
        $roles = Role::all();


        return view('admin.users.create', compact('jabatans', 'golongans', 'pangkats', 'roles'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'nip' => 'required|numeric',
            'email' => 'required|email',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'no_hp'=> 'required|numeric',
            'roles' => 'required'
        ]);
        try {
            $kakan = User::role('kakan')->get();
            $kasubag = User::role('kasubag')->get();
            $kaur = User::role('kaur')->get();
            $bendahara = User::role('bendahara')->get();
            $ppk = User::role('ppk')->get();

            foreach ($request->roles as $role) {
                if ($role === 'kakan' || $role === 'kaur' || $role === 'bendahara' || $role === 'kasubag' || $role === 'ppk') {
                    if ($kasubag->count() != 0 || $kaur->count() != 0 || $kakan->count() != 0 || $bendahara->count() != 0 || $ppk->count() !=0) {
                        return redirect()->route('users.index')->with('error', 'tidak bisa menambahkan Kepala Kantor, Kasubag, Kaur,Pejabat pembuat komitmen dan Bendahara lebih dari satu user');
                    }
                }
            }

            $id=substr(md5($request->get('nip')), 0, 10);
            $user = User::create([
                'id'=> $id,
                'name' => $request->get('name'),
                'nip' => $request->get('nip'),
                'email' => $request->get('email'),
                'jabatan_id'=>$request->get('jabatan'),
                'no_hp'=>$request->get('no_hp'),
                'golongan_id'=>$request->get('golongan'),
                'pangkat_id'=>$request->get('pangkat'),
                'password' => Hash::make($request->get('nip')),
            ]);

            $user->syncRoles($request->roles);

            return redirect()->route('users.index')->with('success', 'User Berhasil ditambahkan');
        }catch (QueryException $exception){
            return redirect()->back()->with('error', 'User Tidak berhasil ditambahkan karena NIP/email/Nomor telfon sama');
        }

    }
    public function show($id){
        $user = User::find($id);
        return view('admin.users.detail', compact('user'));
    }
    public function destroy($id){
        try {
            $user = User::find($id);
//            if ($user->perjalanan->count()>0){
//                return redirect()->route('users.index')->with('error', 'User tidak bisa dihapus karena sudah memiliki dalam perjalanan');
//            }
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User Berhasil dihapuskan');
        }catch (QueryException $exception){
            return redirect()->route('users.index')->with('error', 'User tidak bisa dihapuskan');
        }
    }
}
