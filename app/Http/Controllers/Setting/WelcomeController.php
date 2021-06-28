<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:ajustes']);
    }
    
    public function index(){
        return view('setting.welcome.index');
    }
}
