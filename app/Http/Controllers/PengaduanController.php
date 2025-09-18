<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan; // Pastikan Anda sudah membuat model ini

class PengaduanController extends Controller
{
    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|string|digits:16', // Menggunakan 'digits' untuk memastikan tepat 16 digit
            'nomor_kk' => 'nullable|string|digits:16', // Menggunakan 'digits' untuk memastikan tepat 16 digit
            'desil_dtsen' => 'nullable|string|max:255',
            'no_kis_bpjs' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'nullable|string',
            'nama_pelapor' => 'required|string|max:255',
            'nomor_hp_pelapor' => 'required|string|max:20',
            'email_pelapor' => 'nullable|email:rfc,dns|max:255', // Validasi email lebih ketat
            'pekerjaan_pelapor' => 'nullable|string|max:255',
            'jenis_pmks' => 'required|string|max:255',
            'isi_aduan' => 'required|string',
            'jenis_bantuan' => 'required|string|max:255',
            'kondisi_ekonomi_pmks' => 'nullable|string|max:255',
            'kondisi_sosial_pmks' => 'nullable|string|max:255',
            'foto_pmks' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('foto_pmks')) {
            $imagePath = $request->file('foto_pmks')->store('uploads', 'public');
            // Pastikan Anda sudah menjalankan `php artisan storage:link`
        }

        // Simpan data ke database
        // Anda perlu membuat Model Pengaduan dan migrasinya terlebih dahulu.
        // Contoh:
        // php artisan make:model Pengaduan -m
        // Lalu edit file migrasi yang terbentuk.

        Pengaduan::create([
            'nama' => $validatedData['nama'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'nik' => $validatedData['nik'],
            'nomor_kk' => $validatedData['nomor_kk'],
            'desil_dtsen' => $validatedData['desil_dtsen'],
            'no_kis_bpjs' => $validatedData['no_kis_bpjs'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'alamat_ktp' => $validatedData['alamat_ktp'],
            'alamat_domisili' => $validatedData['alamat_domisili'],
            'nama_pelapor' => $validatedData['nama_pelapor'],
            'nomor_hp_pelapor' => $validatedData['nomor_hp_pelapor'],
            'email_pelapor' => $validatedData['email_pelapor'],
            'pekerjaan_pelapor' => $validatedData['pekerjaan_pelapor'],
            'jenis_pmks' => $validatedData['jenis_pmks'],
            'isi_aduan' => $validatedData['isi_aduan'],
            'jenis_bantuan' => $validatedData['jenis_bantuan'],
            'kondisi_ekonomi_pmks' => $validatedData['kondisi_ekonomi_pmks'],
            'kondisi_sosial_pmks' => $validatedData['kondisi_sosial_pmks'],
            'foto_pmks_path' => $imagePath, // Kolom untuk menyimpan path gambar
            // Anda mungkin juga ingin menambahkan kolom status pengaduan, tanggal_laporan, dll.
        ]);

        return redirect()->route('home')->with('success', 'Pengaduan Anda berhasil dikirim! Petugas akan segera memproses laporan Anda.');
    }
    public function tracking(Request $request)
{
    $kode = $request->input('kode_pengaduan');

    $pengaduan = null;
    if ($kode) {
        $pengaduan = \App\Models\Pengaduan::where('kode_pengaduan', $kode)->first();
    }

    return view('pengaduan.tracking', compact('pengaduan'));
}

}
