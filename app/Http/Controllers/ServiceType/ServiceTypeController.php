<?php

namespace App\Http\Controllers\ServiceType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:tipo de servicio']);
    }

    public function index(){
        return view('service-type.index');
    }
}
