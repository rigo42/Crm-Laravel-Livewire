<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:clientes']);
        $this->middleware(['client'])->except('index', 'create');
    }

    public function index(){
        return view('client.index');
    }

    public function create(){
        $client = new Client();
        return view('client.create', compact('client'));
    }

    public function show(Client $client){
        return view('client.show', compact('client'));
    }

    public function edit(Client $client){
        return view('client.edit', compact('client'));
    }
}
