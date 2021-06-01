<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }
}
