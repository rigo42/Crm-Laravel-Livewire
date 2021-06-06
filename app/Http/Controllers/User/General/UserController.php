<?php

namespace App\Http\Controllers\User\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:usuarios'])->only('index', 'create');
    }

    public function index(){
        return view('user.general.index');
    }

    public function create(){
        $user = new User();
        return view('user.general.create', compact('user'));
    }

    public function show(User $user){
        $this->validateUserPermission($user);
        return view('user.general.show', compact('user'));
    }

    public function edit(User $user){
        $this->validateUserPermission($user);
        return view('user.general.edit', compact('user'));
    }

    public function validateUserPermission($user){
        $userActual = User::find(Auth::user()->id);
        if($user->id != $userActual->id){
            if(!$userActual->hasAnyPermission(['usuarios'])){
                return abort(403);
            }
        }
    }
}
