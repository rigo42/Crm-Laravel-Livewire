<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleAnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:google analytics');
    }

    public function index(){
        return view('google.google-analytics');
    }
}
