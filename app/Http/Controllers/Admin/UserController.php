<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Pengaduan::select('kode_pengaduan', 'nama_pelapor', 'email_pelapor', 'nomor_hp_pelapor')
            ->orderBy('nama_pelapor', 'asc')
            ->get();

        return view('admin.pengguna.pelapor', compact('users'));
    }
}
