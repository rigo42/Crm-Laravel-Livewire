<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{
    public function index(){
        return view('setting.category-service.index');
    }
}
