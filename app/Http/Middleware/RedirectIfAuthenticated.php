<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                $user = User::find(Auth::user()->id);

                if ($user->hasRole('admin')) {
                    $redirect = 'home';

                } elseif ($user->hasRole('kakan')) {
                    $redirect = 'kakan.persetujuan';

                } elseif ($user->hasRole('kaur')) {
                    $redirect = 'kaur.persetujuan';

                } elseif ($user->hasRole('kasubag')) {
                    $redirect = 'kasubag.persetujuan';

                } else {
                    $redirect = 'pegawai.perjalanan';
                }

                return redirect(route($redirect));

            }
        }

        return $next($request);
    }
}
