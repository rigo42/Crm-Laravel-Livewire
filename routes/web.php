<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Google\GoogleAnalyticsController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Prospect\ProspectController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Service\ProjectController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\ServiceType\ServiceTypeController;
use App\Http\Controllers\Setting\AccountController;
use App\Http\Controllers\Setting\BackupController;
use App\Http\Controllers\Setting\CategoryClientController;
use App\Http\Controllers\Setting\CategoryExpenseController;
use App\Http\Controllers\Setting\PaymentTypeController;
use App\Http\Controllers\Setting\PermissionController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Controllers\Setting\WelcomeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



//Login
Auth::routes(['register' => false]);


Route::middleware(['auth'])->group(function () {
        
    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    //Dashboard
    Route::get('/google-analytics', [GoogleAnalyticsController::class, 'index'])->name('google.analytics');

    //Setting
    Route::prefix('ajustes')->group(function () {
        //Welcome
        Route::get('/', [WelcomeController::class, 'index'])->name('setting.welcome.index');
        //Permission
        Route::resource('permisos', PermissionController::class)->parameters(['permisos' => 'permission'])->names('setting.permission');
        //Role
        Route::resource('roles', RoleController::class)->parameters(['roles' => 'role'])->names('setting.role');
        //Category client
        Route::resource('categoria-clientes', CategoryClientController::class)->parameters(['categoria-clientes' => 'categoryClient'])->names('setting.category-client');
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

    //Prospect
    Route::get('prospectos/{prospect}/become-to-client', [ProspectController::class, 'becomeToClient'])->name('prospect.become-to-client');
    Route::resource('prospectos', ProspectController::class)->parameters(['prospectos' => 'prospect'])->names('prospect');

    //Client
    Route::resource('clientes', ClientController::class)->parameters(['clientes' => 'client'])->names('client');

    //Provider
    Route::resource('proveedores', ProviderController::class)->parameters(['proveedores' => 'provider'])->names('provider');

    //Services Type
    Route::resource('tipos-de-servicios', ServiceTypeController::class)->parameters(['tipos-de-servicios' => 'serviceType'])->names('service-type');

    //Services Type
    Route::resource('tipos-de-servicios', ServiceTypeController::class)->parameters(['tipos-de-servicios' => 'serviceType'])->names('service-type');

    //Service
    Route::resource('servicios', ServiceController::class)->parameters(['servicios' => 'service'])->names('service');

    //Project
    Route::resource('proyectos', ProjectController::class)->parameters(['proyectos' => 'service'])->names('project');

    //Quotation
    Route::resource('cotizaciones', QuotationController::class)->parameters(['cotizaciones' => 'quotation'])->names('quotation');

    //Invoice
    Route::resource('facturas', InvoiceController::class)->parameters(['facturas' => 'invoice'])->names('invoice');

    //Payment
    Route::resource('pagos', PaymentController::class)->parameters(['pagos' => 'payment'])->names('payment');

    //Expense
    Route::resource('gastos', ExpenseController::class)->parameters(['gastos' => 'expense'])->names('expense');


});