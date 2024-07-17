<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\IplController;
use App\Http\Controllers\PenangananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('dashboard', DashboardController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('admin/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard')->middleware('admin');
    Route::get('dashboard', [UsersController::class, 'index'])->middleware(['auth', 'tr']);
    Route::get('dashboard', [UsersController::class, 'index'])->middleware(['auth', 'eg']);
    Route::get('dashboard', [UsersController::class, 'index'])->middleware(['auth', 'fa']);
});

Route::resource('tower', TowerController::class);

Route::resource('lantai', LantaiController::class);

Route::resource('unit', UnitController::class);

Route::resource('pemilik', PemilikController::class);

Route::resource('penyewa', PenyewaController::class);

route::get('unit', [UnitController::class, 'index'])->name('unit');
// route::get('kepenghunian', [KepenghunianController::class, 'index'])->name('kepenghunian');
Route::get('kepenghunian', [KepenghunianController::class, 'index'])->name('kepenghunian.index');
Route::get('kepenghunian/create', [KepenghunianController::class, 'create'])->name('kepenghunian.create');
Route::post('kepenghunian', [KepenghunianController::class, 'store'])->name('kepenghunian.store');
route::get('dashboard', [DashboardController::class, 'index'])->name('home');
Route::resource('kepenghunian', KepenghunianController::class);

Route::get('komplain', [KomplainController::class, 'index'])->name('komplain.index');
Route::get('komplain/create', [KomplainController::class, 'create'])->name('komplain.create');
Route::post('komplain', [KomplainController::class, 'store'])->name('komplain.store');
Route::get('/get-units/{unit}', [KomplainController::class, 'getUnits']);
Route::resource('komplain', KomplainController::class);

Route::resource('akun', AkunController::class);

Route::get('ipl', [IplController::class, 'index'])->name('ipl.index');
Route::get('ipl/create', [IplController::class, 'create'])->name('ipl.create');
Route::post('ipl', [IplController::class, 'store'])->name('ipl.store');
Route::get('/get-owner-info-by-name/{unitName}', [IplController::class, 'getOwnerInfoByName']);
// Route::delete('/ipl/{ipl}', [IplController::class, 'destroy'])->name('ipl.destroy');
Route::resource('ipl', IplController::class);

Route::resource('penanganan', PenangananController::class);
