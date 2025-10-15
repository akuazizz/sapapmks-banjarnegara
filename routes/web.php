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

// Halaman utama (home.blade.php)
Route::get('/', function () {
  return view('home');
});

// Form pengaduan baru (create)
Route::get('/pengaduan/create', [PengaduanController::class, 'index'])->name('pengaduan.create');

// Proses penyimpanan pengaduan
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

// Halaman tracking pengaduan
Route::get('/tracking', [PengaduanController::class, 'tracking'])->name('pengaduan.tracking');

// Halaman sukses setelah tracking berhasil
Route::get('/tracking/success/{kode}', [PengaduanController::class, 'trackingSuccess'])->name('pengaduan.success');

// Detail laporan berdasarkan kode
Route::get('/pengaduan/detail/{kode}', [PengaduanController::class, 'detailLaporan'])->name('pengaduan.detail');

/*
|--------------------------------------------------------------------------
| Routes untuk Admin (Dilindungi Middleware)
|--------------------------------------------------------------------------
*/

// Login admin
Route::get('/login', [DashboardController::class, 'login'])->name('login');
Route::post('/login', [DashboardController::class, 'authenticate']);

// Group route untuk admin
Route::middleware(['auth', 'is_admin'])
  ->prefix('admin')
  ->name('admin.') // <-- Ditambahkan agar semua route di dalam group ini otomatis punya prefix nama "admin."
  ->group(function () {

    // Dashboard admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Logout admin
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    /*
        |--------------------------------------------------------------------------
        | Rute Pengaduan (Admin)
        |--------------------------------------------------------------------------
        */
    Route::get('/pengaduan', [PengaduanAdminController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanAdminController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanAdminController::class, 'update'])->name('pengaduan.update');

    // Export data pengaduan ke Excel
    Route::get('/pengaduan/export/excel', [App\Http\Controllers\Admin\PengaduanAdminController::class, 'exportExcel'])
      ->name('pengaduan.export.excel');

    /*
        |--------------------------------------------------------------------------
        | Rute Pengguna (Pelapor)
        |--------------------------------------------------------------------------
        */
    Route::get('/pengguna', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('pengguna.index');
  });
