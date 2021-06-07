<?php

use App\Http\Controllers\Client\General\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Setting\PermissionController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Controllers\Setting\WelcomeController;
use App\Http\Controllers\User\General\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




//Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//Login
Auth::routes(['register' => false]);

//Setting
Route::prefix('ajustes')->group(function () {
    //Welcome
    Route::get('/', [WelcomeController::class, 'index'])->name('setting.welcome.index');
    //Permission
    Route::resource('permisos', PermissionController::class)->parameters(['permisos' => 'permission'])->names('setting.permission');
    //Role
    Route::resource('roles', RoleController::class)->parameters(['roles' => 'role'])->names('setting.role');
});

//User
Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'user'])->names('user.general');
Route::prefix('usuarios/{user}')->group(function () {
    //Password
    Route::get('password', [UserController::class, 'password'])->name('user.general.password');
    //Permission
    Route::get('permisos', [UserController::class, 'permission'])->name('user.general.permission');
});

//Clients
Route::resource('clientes', ClientController::class)->parameters(['clientes' => 'client'])->names('client');


