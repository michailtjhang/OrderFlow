<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/');
        }
    }
}
