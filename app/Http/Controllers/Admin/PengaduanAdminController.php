<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanAdminController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        return view('pengaduan.index', compact('pengaduans'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Diversifikasi,Diproses,Selesai',
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
