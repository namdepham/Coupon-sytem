<?php

namespace App\Http\Middleware;

use App\Models\AppUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class checkRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Session::put('app_id',  $request->app);
        if (! Auth::guard()->user() && ! Cookie::get('user_phonenumber')) {
            return redirect()->route('user.register');
        }
        if (Cookie::get('user_phonenumber')) {
            $phonenumber = Cookie::get('user_phonenumber');
            $user = User::query()
                ->where('phonenumber', $phonenumber)
                ->first();
            if ($user == null) {
                return redirect()->route('user.register');
            }
            $userApp = AppUser::query()
                ->where('app_id','=', $request->app)
                ->where('user_id','=', $user->id)
                ->get();
            if (!$userApp)
            {
                return redirect()->route('user.register');
            }
        }

        return $next($request);
    }
}
