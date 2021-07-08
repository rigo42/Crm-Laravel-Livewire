<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;

class DashboardController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $servicesCutThisWeek = Service::weekCutService();
        return view('dashboard.index', compact('servicesCutThisWeek'));
    }
}
