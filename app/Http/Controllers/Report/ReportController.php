<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:reportes']);
    }

    public function index(){
        return view('report.index');
    }

    public function user(){
        return view('report.user');
    }
}
