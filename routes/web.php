<?php

use App\Http\Controllers;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('dashboard');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', Controllers\ProjectController::class);

    Route::patch('tasks/priority', [Controllers\TaskController::class, 'updatePriority'])->name('tasks.update.priority');
    Route::resource('tasks', Controllers\TaskController::class);
});

require __DIR__.'/auth.php';
