<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;


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

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $user = User::whereEmail($request->input('email'))->first();

            if ($user) {
                $user->anzahlfehler += 1;
                $user->letzterfehler = now();
                $user->save();
                return redirect('login')->withErrors(['password' => 'Invalid Passwort']);
            }

            return redirect('login')->withErrors(['email' => 'Invalid Email']);
        }
        return redirect()->intended('dashboard');
    }



    protected function authenticated(Request $request, $user): \Illuminate\Http\RedirectResponse
    {
        $user->letzteanmeldung = now();
        $user->anzahlanmeldungen += 1;
        $user->save();

        return redirect()->intended($this->redirectPath());
    }
}