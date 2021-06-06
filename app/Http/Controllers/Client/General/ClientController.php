<?php

namespace App\Http\Controllers\Client\General;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:clientes']);
    }

    public function index(){
        return view('client.general.index');
    }

    public function create(){
        $client = new Client();
        return view('client.general.create', compact('client'));
    }

    public function show(Client $client){
        return view('client.general.show', compact('client'));
    }

    public function edit(Client $client){
        return view('client.general.edit', compact('client'));
    }
}
