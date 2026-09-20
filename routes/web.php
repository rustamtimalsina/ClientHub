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
use App\Http\Controllers\Auth\PasswordResetController;
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');


Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

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
Route::get('/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('admin.projects.edit');
Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');
    Route::get('/projects/{project}/milestones', [AdminMilestoneController::class, 'create'])->name('admin.milestones.create');
Route::post('/projects/{project}/milestones', [AdminMilestoneController::class, 'store'])->name('admin.milestones.store');
Route::put('/projects/{project}/milestones/{milestone}', [AdminMilestoneController::class, 'update'])->name('admin.milestones.update');
Route::delete('/projects/{project}/milestones/{milestone}', [AdminMilestoneController::class, 'destroy'])->name('admin.milestones.destroy');

   Route::get('/projects/{project}/invoices', [AdminInvoiceController::class, 'create'])->name('admin.invoices.create');
Route::post('/projects/{project}/invoices', [AdminInvoiceController::class, 'store'])->name('admin.invoices.store');
Route::put('/projects/{project}/invoices/{invoice}', [AdminInvoiceController::class, 'update'])->name('admin.invoices.update');
Route::delete('/projects/{project}/invoices/{invoice}', [AdminInvoiceController::class, 'destroy'])->name('admin.invoices.destroy');
    Route::get('/clients', [AdminClientController::class, 'create'])->name('admin.clients.create');
    Route::post('/clients', [AdminClientController::class, 'store'])->name('admin.clients.store');
});