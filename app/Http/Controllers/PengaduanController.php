<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function create()
    {
        // Untuk tahap 1 dari form pengaduan
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        // Logic untuk menyimpan data pengaduan akan ditaruh di sini
        // Untuk sementara, kita hanya akan melakukan redirect atau menampilkan pesan sukses
        return redirect()->route('home')->with('success', 'Pengaduan berhasil dikirim!');
    }
}
