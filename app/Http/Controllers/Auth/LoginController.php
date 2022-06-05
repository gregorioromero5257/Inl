<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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

    /**6
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    //
    protected function credentials(Request $request)
{
    return $request->only($this->username(), 'password') + ['is_active' => 1];
}

    // public function login(Request $request)
    // {
    //   if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1])) {
    //     // Authentication was successful...
    //     return redirect()->to('home');
    //   }
    // }
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
