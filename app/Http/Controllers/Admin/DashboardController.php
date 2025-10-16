<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function index()
    {
        // 1. Hitung Statistik Pengaduan
        $statusCounts = Pengaduan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();

        // Siapkan array untuk kartu statistik, dengan default 0
        $stats = [
            // 'Laporan Baru' diambil dari status 'Diajukan' (sesuai figma)
            'Laporan Baru' => $statusCounts['Diajukan'] ?? 0,
            'Diverifikasi' => $statusCounts['Diverifikasi'] ?? 0,
            'Diproses' => $statusCounts['Diproses'] ?? 0,
            'Ditolak' => $statusCounts['Ditolak'] ?? 0, // Asumsi Anda akan menambahkan status Ditolak
            'Selesai' => $statusCounts['Selesai'] ?? 0,
        ];

        // Total Seluruh Pengaduan (untuk kartu "Diajukan" jika ingin dihitung semua yang masuk)
        $stats['Diajukan'] = array_sum($stats); // Menghitung total seluruh pengaduan yang ada (yang sudah masuk)

        // Asumsi "Laporan Baru" adalah status 'Diajukan' yang belum diubah
        $stats['Laporan Baru'] = $statusCounts['Diajukan'] ?? 0;

        // 2. Ambil Notifikasi Terbaru (misalnya 5 laporan terakhir, diurutkan berdasarkan jenis PMKS)
        $notifikasi = Pengaduan::orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['jenis_pmks', 'created_at']);

        // 3. Siapkan data untuk Chart (sesuai status yang ingin ditampilkan di chart)
        $chartData = [
            'Laporan Baru'   => $stats['Laporan Baru'],
            'Diverifikasi'  => $stats['Diverifikasi'],
            'Diproses'       => $stats['Diproses'],
            'Ditolak'        => $stats['Ditolak'],
            'Diajukan'       => $stats['Diajukan'],
            'Selesai'        => $stats['Selesai'],
        ];


        return view('admin.dashboard', compact('stats', 'notifikasi', 'chartData'));
    }
}
