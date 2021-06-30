<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Prospect\ProspectController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Setting\AccountController;
use App\Http\Controllers\Setting\BackupController;
use App\Http\Controllers\Setting\CategoryExpenseController;
use App\Http\Controllers\Setting\CategoryServiceController;
use App\Http\Controllers\Setting\PaymentTypeController;
use App\Http\Controllers\Setting\PermissionController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Controllers\Setting\WelcomeController;
use App\Http\Controllers\User\UserController;
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
    //Category Service
    Route::resource('categoria-servicios', CategoryServiceController::class)->parameters(['categoria-servicios' => 'categoryService'])->names('setting.category-service');
    //Category expense
    Route::resource('categoria-gastos', CategoryExpenseController::class)->parameters(['categoria-gastos' => 'categoryExpense'])->names('setting.category-expense');
    //Payment Type
    Route::resource('tipos-de-pagos', PaymentTypeController::class)->parameters(['tipos-de-pagos' => 'paymentType'])->names('setting.payment-type');
    //Accounts
    Route::resource('cuentas', AccountController::class)->parameters(['cuentas' => 'account'])->names('setting.account');
    //Backup
    Route::resource('copias-de-seguridad', BackupController::class)->parameters(['copia-de-seguridad' => 'backup'])->names('setting.backup');
});

//User
Route::resource('usuarios', UserController::class)->parameters(['usuarios' => 'user'])->names('user');
Route::prefix('usuarios/{user}')->group(function () {
    //Password
    Route::get('password', [UserController::class, 'password'])->name('user.password');
    //Permission
    Route::get('permisos', [UserController::class, 'permission'])->name('user.permission');
    //Prospect
    Route::get('prospectos', [UserController::class, 'prospect'])->name('user.prospect');
    //Transfer Prospect
    Route::get('transferir', [UserController::class, 'transfer'])->name('user.transfer');
    //Client
    Route::get('clientes', [UserController::class, 'client'])->name('user.client');
    //Payment
    Route::get('pagos', [UserController::class, 'payment'])->name('user.payment');
    //Expense
    Route::get('gastos', [UserController::class, 'expense'])->name('user.expense');
});

//Prospects
Route::get('prospectos/{prospect}/become-to-client', [ProspectController::class, 'becomeToClient'])->name('prospect.become-to-client');
Route::resource('prospectos', ProspectController::class)->parameters(['prospectos' => 'prospect'])->names('prospect');

//Clients
Route::resource('clientes', ClientController::class)->parameters(['clientes' => 'client'])->names('client');

//Quotations
Route::resource('cotizaciones', QuotationController::class)->parameters(['cotizaciones' => 'quotation'])->names('quotation');

//Services
Route::resource('servicios', ServiceController::class)->parameters(['servicios' => 'service'])->names('service');

//Invoices
Route::resource('facturas', InvoiceController::class)->parameters(['facturas' => 'invoice'])->names('invoice');

//Payment
Route::resource('pagos', PaymentController::class)->parameters(['pagos' => 'payment'])->names('payment');

//Expenses
Route::resource('gastos', ExpenseController::class)->parameters(['gastos' => 'expense'])->names('expense');


