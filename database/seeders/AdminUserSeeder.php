<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User diimport

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data user lama jika ada, untuk menghindari duplikasi
        // DB::table('users')->delete();

        // Buat user admin baru
        User::create([
            'name' => 'Admin SAPA PMKS',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);
    }
}
