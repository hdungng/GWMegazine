<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        switch ($user->role->name) {
            case 'Root':
            case 'Admin':
            case 'Coordinator':
                return redirect()->route('admin.dashboard');
            case 'Student':
            case 'Guest':
                return redirect()->route('home.main-page');
            default:
                return redirect()->route('home.main-page');
        }
    }

    public function sendFailedLoginResponse(Request $request)
    {
        $message = 'Invalid username or password.';

        return back()->withInput($request->only('email', '_token'))->withErrors(['email' => $message]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
