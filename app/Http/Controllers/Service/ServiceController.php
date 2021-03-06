<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:servicios']);
        $this->middleware(['service'])->except('index', 'create');
    }

    public function index(){
        return view('service.service.index');
    }

    public function create(){
        $service = new Service();
        return view('service.service.create', compact('service'));
    }

    public function show(Service $service){
        return view('service.service.show', compact('service'));
    }

    public function edit(Service $service){
        return view('service.service.edit', compact('service'));
    }
}
