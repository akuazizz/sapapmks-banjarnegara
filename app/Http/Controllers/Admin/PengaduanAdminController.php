<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengaduanExport;
use Carbon\Carbon;

class PengaduanAdminController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query
        $query = Pengaduan::orderBy('created_at', 'desc');

        // 1. Filter Pencarian (Cari...)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('kode_pengaduan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('nama_pelapor', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jenis_pmks', 'like', '%' . $searchTerm . '%');
            });
        }

        // 2. Filter Status (Semua Status)
        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $query->where('status', $request->status);
        }

        // 3. Filter Tanggal
        if ($request->filled('tanggal')) {
            // Asumsi input tanggal memiliki format 'Y-m-d'
            $query->whereDate('created_at', $request->tanggal);
        }

        $pengaduans = $query->get();

        // Status yang tersedia untuk dropdown filter
        $statuses = ['Semua Status', 'Diterima', 'Diverifikasi', 'Diproses', 'Selesai', 'Ditolak'];

        return view('pengaduan.index', compact('pengaduans', 'statuses'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        // Status yang tersedia untuk dropdown
        $statuses = ['Diterima', 'Diverifikasi', 'Diproses', 'Selesai', 'Ditolak'];
        return view('admin.pengaduan.edit', compact('pengaduan', 'statuses'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        // 1. Validasi Dasar
        $rules = [
            'status' => 'required|in:Diterima,Diverifikasi,Diproses,Selesai,Ditolak',
            'alasan_penolakan' => 'nullable|string|max:500', // Default nullable
        ];

        // 2. Validasi Kondisional untuk DITOLAK
        if ($request->status === 'Ditolak') {
            // Jika statusnya Ditolak, Alasan wajib diisi
            $rules['alasan_penolakan'] = 'required|string|max:500';
        }

        $validatedData = $request->validate($rules);

        // 3. Bersihkan alasan jika status TIDAK DITOLAK
        if ($request->status !== 'Ditolak') {
            $validatedData['alasan_penolakan'] = null;
        }

        // 4. Update Data
        $pengaduan->update($validatedData);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function exportExcel(Request $request)
    {
        $status = $request->status;
        $tanggal = $request->filled('tanggal')
            ? Carbon::parse($request->tanggal)->format('Y-m-d')
            : null;

        return Excel::download(new PengaduanExport($status, $tanggal), 'pengaduan.xlsx');
    }
}
