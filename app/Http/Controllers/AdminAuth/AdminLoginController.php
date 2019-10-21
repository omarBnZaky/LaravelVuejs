<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class AdminLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *admin
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('adminAuth.login');
    }
    protected function guard(){
        return Auth::guard('admin');
    }

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route('admin.login'));
    }


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}
