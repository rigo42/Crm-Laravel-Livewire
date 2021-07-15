<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:proveedores']);
    }

    public function index(){
        return view('provider.index');
    }
}
