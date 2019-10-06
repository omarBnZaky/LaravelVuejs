<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrgController extends Controller
{
    public function index()
    {
        return view('organization.dashboard');
    }
}
