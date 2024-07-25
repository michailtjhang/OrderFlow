<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd('hello');
        return view('admin.dashboard',['page_title' => 'Dashboard']);
    }
}