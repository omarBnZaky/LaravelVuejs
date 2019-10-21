<?php

namespace App\Http\Controllers\OrgAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if(Auth::guard('organization')->check()){
            return redirect()->route('org.dashboard');
        }
        return view('orgAuth.login');
    }
    protected function guard(){
        return Auth::guard('organization');
    }

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/org/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function logout(Request $request)
    {
        Auth::guard('organization')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route('org.login'));
    }

    public function __construct()
    {
        $this->middleware('guest:organization')->except('logout');
    }
}
