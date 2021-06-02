<?php

use App\Http\Controllers\Client\General\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

//Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//Clients
Route::resource('clientes', ClientController::class)->parameters(['clientes' => 'client'])->names('client');
