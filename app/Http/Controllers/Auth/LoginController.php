<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt(array('email'=>$input['email'], 'password'=>$input['password']))){
            $user = auth()->user();

            if ($user->status != 'AKTIF') {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Akaun anda tidak aktif. Sila hubungi pihak pentadbir sistem.');
            }

            if(auth()->user()->type == 'admin')
            {
                return redirect()->route('admin.dashboard');
            }
            else if(auth()->user()->type == 'advisor')
            {
                return redirect()->route('advisor.dashboard');
            } 
            else 
            {
                return redirect()->route('user.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', 'email or password is incorrect.');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
