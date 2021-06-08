<?php

namespace App\Http\Controllers\Prospect;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Prospect;

class ProspectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:prospectos']);
    }

    public function index(){
        return view('prospect.index');
    }

    public function create(){
        $prospect = new Prospect();
        return view('prospect.create', compact('prospect'));
    }

    public function show(Prospect $prospect){
        return view('prospect.show', compact('prospect'));
    }

    public function edit(Prospect $prospect){
        return view('prospect.edit', compact('prospect'));
    }

    public function becomeToClient(Prospect $prospect){
        $client = new Client();
        $client->user_id = $prospect->user_id;
        $client->user_id = $prospect->user_id;
        $client->user_id = $prospect->user_id;
        $client->user_id = $prospect->user_id;
        $client->user_id = $prospect->user_id;
        
        
    }
}
