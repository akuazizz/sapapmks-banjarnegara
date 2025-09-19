<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('home');
});

// Route untuk menampilkan halaman formulir pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.create');

// Route untuk menyimpan data pengaduan
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

// Route untuk halaman tracking utama
Route::get('/tracking', [PengaduanController::class, 'tracking'])->name('pengaduan.tracking');

// Route untuk halaman sukses setelah pengaduan (jika Anda masih menggunakannya)
Route::get('/pengaduan/success/{kode}', [PengaduanController::class, 'trackingSuccess'])->name('pengaduan.success');

// Route baru untuk menampilkan detail laporan
Route::get('/pengaduan/{kode}/detail', [PengaduanController::class, 'detailLaporan'])->name('pengaduan.detail');
