<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:organization');
    }

    public function index()
    {
//        dd(Auth::guard('organization')->user()->id);
        return view('organization.dashboard');
    }
}
