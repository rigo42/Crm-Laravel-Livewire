<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:proyectos']);
        $this->middleware(['service'])->except('index', 'create');
    }

    public function index(){
        return view('service.project.index');
    }

    public function create(){
        $service = new Service();
        return view('service.project.create', compact('service'));
    }

    public function show(Service $service){
        return view('service.project.show', compact('service'));
    }

    public function edit(Service $service){
        return view('service.project.edit', compact('service'));
    }
}
