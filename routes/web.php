<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaduanAdminController;

/*
|--------------------------------------------------------------------------
| Routes untuk Pengguna Publik (Tidak Perlu Login)
|--------------------------------------------------------------------------
*/
// Ini adalah halaman home.blade.php yang Anda inginkan
Route::get('/', function () {
  return view('home');
});

// Arahkan ke controller PengaduanController untuk membuat pengaduan
Route::get('/pengaduan/create', [PengaduanController::class, 'index'])->name('pengaduan.create');

// Ini adalah rute untuk memproses pengaduan baru
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

// Ini adalah rute untuk halaman tracking
Route::get('/tracking', [PengaduanController::class, 'tracking'])->name('pengaduan.tracking');

Route::get('/tracking/success/{kode}', [PengaduanController::class, 'trackingSuccess'])->name('pengaduan.success');
Route::get('/pengaduan/detail/{kode}', [PengaduanController::class, 'detailLaporan'])->name('pengaduan.detail');

/*
|--------------------------------------------------------------------------
| Routes untuk Admin (Dilindungi Middleware)
|--------------------------------------------------------------------------
*/
Route::get('/login', [DashboardController::class, 'login'])->name('login');
Route::post('/login', [DashboardController::class, 'authenticate']);

Route::middleware(['auth', 'is_admin'])
  ->prefix('admin')
  ->name('admin.') // <-- TAMBAH BARIS INI
  ->group(function () {

    // Semua route di dalam group ini akan memiliki prefix 'admin/' dan nama diawali 'admin.'

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Nama rute jadi 'admin.dashboard'
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout'); // Nama rute jadi 'admin.logout'

    // Rute Pengaduan:
    Route::get('/pengaduan', [PengaduanAdminController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanAdminController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanAdminController::class, 'update'])->name('pengaduan.update');

    // Rute Export Excel BARU (Perhatikan: nama rute sekarang hanya perlu 'pengaduan.export.excel')
    Route::get('pengaduan/export/excel', [App\Http\Controllers\Admin\PengaduanAdminController::class, 'exportExcel'])
      ->name('pengaduan.export.excel');

    // Rute Pengguna
    Route::get('/pengguna', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('pengguna.index');
  });
