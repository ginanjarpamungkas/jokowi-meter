<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{
    use AuthenticatesUsers;

    protected $redirectTo = '/jokowimeter';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
