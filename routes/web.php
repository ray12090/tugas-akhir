<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\KepenghunianController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
route::get('dashboard', [UsersController::class, 'index'])->middleware(['auth', 'tr']);
route::get('dashboard', [UsersController::class, 'index'])->middleware(['auth', 'eg']);
route::get('dashboard', [UsersController::class, 'index'])->middleware(['auth', 'fa']);

route::get('unit', [UnitController::class, 'index'])->name('unit');
// route::get('kepenghunian', [KepenghunianController::class, 'index'])->name('kepenghunian');
Route::get('kepenghunian', [KepenghunianController::class, 'index'])->name('kepenghunian.index');
route::get('dashboard', [DashboardController::class, 'index'])->name('home');
