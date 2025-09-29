<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna (admin)
     */
    public function index(Request $request)
    {
        $query = User::orderBy('name', 'asc');

        // Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%');
        }

        // Ambil semua pengguna, atau jika Anda hanya ingin menampilkan pengguna yang bukan admin, gunakan ->where('is_admin', 0)
        // Saat ini, kita tampilkan semua, karena semua yang login adalah Admin/User internal.
        $users = $query->get();

        return view('admin.pengguna.index', compact('users'));
    }
}
