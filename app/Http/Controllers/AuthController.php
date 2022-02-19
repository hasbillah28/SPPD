<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required', 'max:18'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = User::find(Auth::user()->id);

            if ($user->hasRole('admin')) {
                $redirect = 'dashboard';

            } elseif ($user->hasRole('kakan')) {
                $redirect = 'kakan.persetujuan';

            } elseif ($user->hasRole('kaur')) {
                $redirect = 'kaur.perjalanan';

            } elseif ($user->hasRole('kasubag')) {
                $redirect = 'kasubag.perjalanan';

            } else {
                $redirect = 'pegawai.perjalanan';
            }

            return redirect(route($redirect));
        }

        return back()->with('error', 'NIP atau password yang dimasukkan tidak terdaftar');
    }

    public function index()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
