<?php

namespace App\Http\Controllers\Client\General;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('client.general.index');
    }

    public function create(){
        $client = new Client();
        return view('client.general.create', compact('client'));
    }

    public function edit(Client $client){
        return view('client.general.edit', compact('client'));
    }
}
