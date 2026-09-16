<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::post('/milestones/{milestone}/complete', [MilestoneController::class, 'complete'])
    ->middleware('auth')
    ->name('milestones.complete');

Route::get('/files/{projectFile}/download', [ProjectFileController::class, 'download'])
    ->middleware('auth')
    ->name('files.download');

Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])
    ->middleware('auth')
    ->name('invoices.download');
