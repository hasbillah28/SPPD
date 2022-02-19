<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct() {

    }

    public function show() {
        $user = Auth::user();

        return view('pegawai.profile.show', compact('user'));
    }


    public function edit() {
        $user = Auth::user();

        return back()->with('edit', $user);
    }

    public function uploadAva(Request $request) {
        $this->validate($request, [
            'avatar' => 'required|file|image'
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar.'.$file->getClientOriginalExtension();
            $filePath = 'public/file/'.$user->id.'/avatar';
            $file->storeAs($filePath, $filename);
        }

        $user->avatar = $filename;

        $user->save();

        return back()->with('success', 'Berhasil update avatar');
    }

    public function deleteAva($id) {
        $user = Auth::user();

        $requestedUser = User::find($id);
        $filename = $requestedUser->avatar;
        $filepath = 'storage/file/'.$user->id.'/avatar/'.$filename;
        if ($user->id == $requestedUser->id) {
            Storage::delete(asset($filepath));

            $requestedUser->avatar = null;
            $requestedUser->save();

            return back()->with('success', 'Berhasil hapus avatar');
        }
    }

    public function updatePass(Request $request) {
        if ($this->passwordIsValid($request->oldPassword)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->newPassword);
            $user->save();
        } else {
            return redirect()->back()->with('error' ,'Password salah, silakan masukkan password lama yang benar');
        }

        return redirect()->back()->with('success', 'Berhasil ganti password');
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'nip' => 'required|numeric',
            'email' => 'required|email',
            'noHp' => 'required|numeric',
        ]);

        $id = Auth::user()->id;

        $user = User::find($id);

        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->email = $request->email;
        $user->no_hp = $request->noHp;

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Berhasil update profile');
    }

    private function passwordIsValid($password) {
        $user = Auth::user();

        return Hash::check($password, $user->getAuthPassword());
    }
}
