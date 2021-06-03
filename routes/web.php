<?php

use App\Http\Controllers\Client\General\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




//Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//Login
Auth::routes(['register' => false]);

//Clients
Route::resource('clientes', ClientController::class)->parameters(['clientes' => 'client'])->names('client');
