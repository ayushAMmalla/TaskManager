<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/tasks', [AdminController::class, 'tasks'])->name('admin.tasks');
    Route::get('/admin/tasks/create', [AdminController::class, 'createTask'])->name('admin.tasks.create');
    Route::post('/admin/tasks', [AdminController::class, 'storeTask'])->name('admin.tasks.store');
    Route::get('/admin/tasks/{task}/edit', [AdminController::class, 'editTask'])->name('admin.tasks.edit');
    Route::put('/admin/tasks/{task}', [AdminController::class, 'updateTask'])->name('admin.tasks.update');
    Route::delete('/admin/tasks/{task}', [AdminController::class, 'deleteTask'])->name('admin.tasks.delete');
});

Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/tasks', [ManagerController::class, 'tasks'])->name('manager.tasks');
    Route::put('/manager/tasks/{id}', [ManagerController::class, 'updateTask'])->name('manager.tasks.update');
});


require __DIR__ . '/auth.php';
