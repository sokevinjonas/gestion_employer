<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ConfigurationController;

Route::get('auth-login', [AuthController::class, 'login_Vue'])
    ->name('login');

Route::post('auth-login', [AuthController::class, 'login_traitement'])
    ->name('login_traitement');

Route::get('/validate-account/{email}', [AdminController::class, 'defineAccess']);
Route::post('/validate-account', [AdminController::class, 'validateAccess'])
        ->name('EmailvalidateAccess');


Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [PanelController::class, 'index'])
            ->name('panel');
    
    Route::prefix('departements')->group(function() {
        Route::get('/index', [DepartementController::class, 'index'])
            ->name('departement.index');

        Route::get('/create', [DepartementController::class, 'create'])
            ->name('departement.create');
            Route::post('/create', [DepartementController::class, 'store'])
            ->name('departement.store');

        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])
            ->name('departement.edit');
            Route::put('/update/{departement}', [DepartementController::class, 'update'])
            ->name('departement.update');

        Route::get('/delete/{departement}', [DepartementController::class, 'delete'])
        ->name('departement.delete');
    
    });
    Route::prefix('employers')->group(function() {
        Route::get('/index', [EmployerController::class, 'index'])
            ->name('employer.index');

        Route::get('/create', [EmployerController::class, 'create'])
            ->name('employer.create');
            Route::post('/store', [EmployerController::class, 'store'])
            ->name('employer.store');

        Route::get('/edit/{employer}', [EmployerController::class, 'edit'])
            ->name('employer.edit');
            Route::put('/update/{employer}', [EmployerController::class, 'update'])
            ->name('employer.update');
        Route::get('/delete/{employer}', [EmployerController::class, 'delete'])
        ->name('employer.delete');
    
    });
    Route::prefix('configuration')->group(function(){
        Route::get('/', [ConfigurationController::class , 'index'])
                ->name('configurations');
        Route::get('/create', [ConfigurationController::class , 'create'])
                ->name('configurations.create');
        Route::post('/store', [ConfigurationController::class , 'store'])
        ->name('configurations.store');
        Route::get('/delete/{lesconfig}', [ConfigurationController::class , 'delete'])
        ->name('configurations.delete');
    });
    Route::prefix('adminDashboard')->group(function(){
        // Route::get('/', [ConfigurationController::class , 'index'])
        //         ->name('configurations');
        Route::get('/create', [AdminController::class , 'create'])
                ->name('adminDashboard.create');
        Route::post('/store', [AdminController::class , 'store'])
        ->name('adminDashboard.store');
        Route::get('/delete', [AdminController::class , 'delete'])
        ->name('adminDashboard.delete');
    });
    Route::prefix('paiement')->group(function(){
        Route::get('/', [PaiementController::class, 'index'])
            ->name('paiement.index');
        Route::get('/lancer-transactions', [PaiementController::class, 'initePaiement'])
            ->name('paiement.init');
    });


    Route::get('/logoutSession', [AuthController::class, 'logout'])->name('logout');
});
