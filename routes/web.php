<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TRController;
use App\Http\Controllers\EGController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


route::get('admin/admin-dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);
route::get('tr/tr-dashboard', [TRController::class, 'index'])->middleware(['auth', 'tr']);
route::get('eg/eg-dashboard', [EGController::class, 'index'])->middleware(['auth', 'eg']);
route::get('fa/fa-dashboard', [FAController::class, 'index'])->middleware(['auth', 'fa']);
