<?php

namespace App\Http\Controllers\OrgAuth;

use App\Backend\Helper\Constant;
use App\Backend\Helper\Functions;
use App\Http\Controllers\Controller;
use App\Organization;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OrgRegisterController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:organization');
    }

    public function showRegisterForm()
    {
        return view('orgAuth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showOrgRegisterForm()
    {
        return view('orgAuth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {
         Organization::create([
            'hash_id' => Functions::generateUniqueHashForModel(new \App\Organization()),
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'status' =>Constant::PENDING,
            'profile'=> "profile.png"
        ]);
        return redirect()->route('org.dashboard');

    }
}
