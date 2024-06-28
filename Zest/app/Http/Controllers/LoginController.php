<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Function to display the login form
    public function index() {
        return view('auth.login');
    }
}
