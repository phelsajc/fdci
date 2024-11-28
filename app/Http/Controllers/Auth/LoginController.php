<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    /****
     * Handle login
     */
    public function login(Request $request) {
        $validate = $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(auth()->attempt($validate)){
            //return redirect()->route('users.index');
            return redirect()->route('contacts.index');
        }else{
            return redirect()->route('login')->with('error','Credentials not found!')->withErrors([
                'email' => 'The provided credentials do not match our records.',
                'password' => 'The password you entered is incorrect.',
            ]);
        }
    }
}
