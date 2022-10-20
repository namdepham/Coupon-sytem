<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterStore;
use App\Models\AppUser;
use App\Models\Stamp;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    /**
     * Show login form.
     *
     * @return Renderable
     */
    public function showLoginForm(): Renderable
    {
        return view('user.auth.login');
    }

    /**
     * @return Renderable
     */
    public function showRegister(): Renderable
    {
        return view('user.auth.register');
    }

    /**
     * @param UserRegisterStore $request
     * @return RedirectResponse
     */
    public function register(UserRegisterStore $request): RedirectResponse
    {
        User::create($request->validated());

        $user = User::where('phonenumber', '=', $request->input('phonenumber'))->first();

        if (empty($user)) {
            abort(404);
        }
        Auth::login($user);
        $stampID = Stamp::query()->where('stamps.app_id', Session::get('app_id'))->first()->id;

        AppUser::updateOrCreate([
            'app_id' => Session::get('app_id'),
            'user_id' => Auth::guard()->user()->id,
            'stamp_id' => $stampID
        ]);
        Cookie::queue('user_name', Auth::guard()->user()->name, 3000);
        Cookie::queue('user_phonenumber', Auth::guard()->user()->phonenumber, 3000);
        Cookie::queue('user_id', Auth::guard()->user()->id, 3000);

        return redirect('/');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }
}
