<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\MilestoneController as AdminMilestoneController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
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

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');

    Route::get('/projects/{project}/milestones', [AdminMilestoneController::class, 'create'])->name('admin.milestones.create');
    Route::post('/projects/{project}/milestones', [AdminMilestoneController::class, 'store'])->name('admin.milestones.store');

    Route::get('/projects/{project}/invoices', [AdminInvoiceController::class, 'create'])->name('admin.invoices.create');
    Route::post('/projects/{project}/invoices', [AdminInvoiceController::class, 'store'])->name('admin.invoices.store');

    Route::get('/clients', [AdminClientController::class, 'create'])->name('admin.clients.create');
    Route::post('/clients', [AdminClientController::class, 'store'])->name('admin.clients.store');
});