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
use App\Http\Controllers\DetailAgamaController;
use App\Http\Controllers\DetailKewarganegaraanController;
use App\Http\Controllers\DetailPerkawinanController;
use App\Http\Controllers\ApprovalRequestPenyewaController;
use App\Http\Controllers\ApprovalRequestPemilikController;
use App\Http\Controllers\JenisKomplainController;
use App\Http\Controllers\StatusKomplainController;
use App\Http\Controllers\LokasiKomplainController;
use App\Http\Controllers\DetailBiayaAdminController;
use App\Http\Controllers\DetailBiayaAirController;
use App\Http\Controllers\DetailTagihanAirController;
use App\Http\Controllers\DetailTempatLahirController;
use App\Http\Controllers\KategoriPenangananController;
use App\Http\Controllers\TipeUserController;
use Illuminate\Support\Facades\Route;

// Redirect to login if not authenticated
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin dashboard route
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('admin/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
});

// Tenant Relation, Engineering, and Finance dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [UsersController::class, 'index'])->middleware('tr');
    Route::get('dashboard', [UsersController::class, 'index'])->middleware('eg');
    Route::get('dashboard', [UsersController::class, 'index'])->middleware('fa');
});

// Resource routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tower', TowerController::class);
    Route::resource('lantai', LantaiController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('pemilik', PemilikController::class);
    Route::resource('penyewa', PenyewaController::class);
    Route::resource('komplain', KomplainController::class);
    Route::resource('akun', AkunController::class);
    Route::resource('ipl', IplController::class);
    Route::resource('penanganan', PenangananController::class);
    Route::resource('detail_agama', DetailAgamaController::class);
    Route::resource('detail_kewarganegaraan', DetailKewarganegaraanController::class);
    Route::resource('detail_perkawinan', DetailPerkawinanController::class);
    Route::resource('approval_request_penyewa', ApprovalRequestPenyewaController::class);
    Route::resource('approval_request_pemilik', ApprovalRequestPemilikController::class);
    Route::resource('jenis_komplain', JenisKomplainController::class);
    Route::resource('status_komplain', StatusKomplainController::class);
    Route::resource('lokasi_komplain', LokasiKomplainController::class);
    Route::resource('detail_biaya_admin', DetailBiayaAdminController::class);
    Route::resource('detail_biaya_air', DetailBiayaAirController::class);
    Route::resource('detail_tagihan_air', DetailTagihanAirController::class);
    Route::resource('detail_tempat_lahir', DetailTempatLahirController::class);
    Route::resource('kategori_penanganan', KategoriPenangananController::class);
    Route::resource('tipe_user', TipeUserController::class);
});

// Additional routes
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/get-units/{unit}', [KomplainController::class, 'getUnits']);
Route::get('/get-lantais/{tower_id}', [UnitController::class, 'getLantais']);
Route::get('/get-owner-info-by-name/{unitName}', [IplController::class, 'getOwnerInfoByName']);
Route::get('/api/pemilik/{pemilikId}/units', [IplController::class, 'getUnitsByPemilik']);
Route::get('/api/pemilik/{nik}', [PemilikController::class, 'getPemilikByNIK']);
Route::get('/generate-nomor-laporan', function () {
    $nomorLaporan = \App\Models\Komplain::generateNomorLaporan();
    return response()->json(['nomor_laporan' => $nomorLaporan]);
});
Route::get('/generate-nomor-penanganan', function () {
    $nomorPenanganan = \App\Models\Penanganan::generateFreshNomorPenanganan();
    return response()->json(['nomor_penanganan' => $nomorPenanganan]);
});
Route::get('createDirect', [PenangananController::class, 'createDirect'])->name('penanganan.createDirect');

// routes/web.php
Route::get('/api/get-kabupaten/{provinceCode}', [PemilikController::class, 'getKabupaten']);
Route::get('/api/get-kecamatan/{cityCode}', [PemilikController::class, 'getKecamatan']);
Route::get('/api/get-kelurahan/{districtCode}', [PemilikController::class, 'getKelurahan']);
Route::get('/komplains/{id}/lokasi', [PenangananController::class, 'getLokasiKomplain']);

Route::get('/api/get-biaya-admin', [DetailBiayaAdminController::class, 'getBiayaAdminBerlaku']);
Route::get('/api/get-biaya-air', [DetailBiayaAirController::class, 'getBiayaAirBerlaku']);
Route::get('/get-unit-pemilik/{id}', [DashboardController::class, 'getUnitPemilik']);
Route::get('/unit-dan-ipl-pemilik/{id}', [DashboardController::class, 'indexUnitdanIPLOwner'])->name('pemilik.unit-dan-ipl');
Route::get('ipl/unit/{unit_id}', [IplController::class, 'show'])->name('ipl.showIPL');
Route::get('ipl/unit/{unit_id}/history', [IplController::class, 'history'])->name('ipl.history');
Route::get('/unit-dan-ipl-penyewa/{id}', [DashboardController::class, 'indexUnitdanIPLRenter'])->name('penyewa.unit-dan-ipl');




// Default route for handling unknown routes
Route::fallback(function () {
    return redirect('/login');
});

require __DIR__.'/auth.php';
