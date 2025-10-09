<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna (pelapor/biasa)
     */
    public function index(Request $request)
    {
        // UBAH: Hanya ambil pengguna yang is_admin = 0 (Pelapor/User Biasa)
        $query = User::where('is_admin', 0)->orderBy('name', 'asc');

        // Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $query->get();

        return view('admin.pengguna.index', compact('users'));
    }
}
