<?php

use App\Http\Controllers\Client\General\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Setting\WelcomeController;
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
});

//Clients
Route::resource('clientes', ClientController::class)->parameters(['clientes' => 'client'])->names('client');


