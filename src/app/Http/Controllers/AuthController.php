<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authLogin()
    {
        return view('apply/index');
    }
}
