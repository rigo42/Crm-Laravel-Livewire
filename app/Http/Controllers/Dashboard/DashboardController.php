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
        $servicesCutThisDay = Service::dayCutService();
        $servicesCutBack = Service::backCutService();
        return view('dashboard.index', compact('servicesCutThisWeek', 'servicesCutThisDay', 'servicesCutBack'));
    }
}
