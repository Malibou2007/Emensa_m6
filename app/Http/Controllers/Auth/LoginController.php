<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


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

    use AuthenticatesUsers {
        sendFailedLoginResponse as protected sendCustomFailedLoginResponse;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        $user = User::whereEmail($request->input('email'))->first();

        if ($user) {
            $user->anzahlfehler += 1;
            $user->letzterfehler = now();
            $user->save();
            return back()->withErrors(['password' => 'Invalid Passwort']);
            }
        return back()->withErrors(['email' => 'Invalid Email']);
    }
    protected function authenticated(Request $request, $user): \Illuminate\Http\RedirectResponse
    {
        $user->letzteanmeldung = now();
        $user->anzahlanmeldungen += 1;
        $user->save();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::whereEmail($request->input('email'))->first();

        if ($user) {
            $user->anzahlfehler += 1;
            $user->letzterfehler = now();
            $user->save();

            return back()->withErrors(['password' => 'Invalid Password']);
        }

        return back()->withErrors(['email' => 'Invalid Email']);
    }
}
