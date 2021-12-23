<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repository\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param $social
     * @return RedirectResponse
     */
    public function socialLogin($social): RedirectResponse
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * @param UserRepository $repository
     * @param $social
     * @return RedirectResponse
     */
    public function socialResponse(UserRepository $repository, $social): RedirectResponse
    {
        $user = Socialite::driver($social)->user();

        $userAuth = $repository->firstOrCreateUser($user, $social);

        auth()->login($userAuth);
        return redirect()->route('news.index');
    }
}
