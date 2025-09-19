<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Tambahkan ini

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'nik' => 'required|digits:16|unique:pengaduans',
            'nomor_kk' => 'nullable|digits:16',
            'desil_dtsen' => 'nullable|max:255',
            'no_kis_bpjs' => 'nullable|max:255',
            'tempat_lahir' => 'nullable|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'nullable',
            'nama_pelapor' => 'required|max:255',
            'nomor_hp_pelapor' => 'required|max:20',
            'email_pelapor' => 'nullable|email',
            'pekerjaan_pelapor' => 'nullable|max:255',
            'jenis_pmks' => 'required|max:255',
            'isi_aduan' => 'required',
            'jenis_bantuan' => 'required|max:255',
            'kondisi_ekonomi_pmks' => 'nullable|max:255',
            'kondisi_sosial_pmks' => 'nullable|max:255',
            'foto_pmks' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tangani upload foto
        if ($request->hasFile('foto_pmks')) {
            $path = $request->file('foto_pmks')->store('foto_pmks', 'public');
            $validatedData['foto_pmks_path'] = $path;
        }

        // Tambahkan status default
        $validatedData['status'] = 'Diterima'; // Ubah dari 'Menunggu Diproses' agar sesuai dengan Figma

        // Buat pengaduan baru
        $pengaduan = Pengaduan::create($validatedData);

        // Tambahkan kode pengaduan
        $pengaduan->kode_pengaduan = 'PMKS-' . date('Y') . '-' . str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT);
        $pengaduan->save();

        // Redirect ke halaman sukses dengan data pengaduan yang sudah lengkap
        return redirect()->route('pengaduan.success', ['kode' => $pengaduan->kode_pengaduan]);
    }

    public function tracking(Request $request)
    {
        $pengaduan = null;
        $riwayat_status = [];

        if ($request->has('kode_pengaduan') && $request->kode_pengaduan != '') {
            $pengaduan = Pengaduan::where('kode_pengaduan', $request->kode_pengaduan)->first();

            if ($pengaduan) {
                // Untuk riwayat status, kita akan membuat array dummy berdasarkan status yang ada
                // Di aplikasi nyata, ini akan diambil dari tabel riwayat status (misalnya, `status_logs`)
                $riwayat_status = $this->generateRiwayatStatus($pengaduan);
            }
        }

        return view('pengaduan.tracking', compact('pengaduan', 'riwayat_status'));
    }

    // Metode baru untuk menampilkan detail laporan
    public function detailLaporan($kode)
    {
        $pengaduan = Pengaduan::where('kode_pengaduan', $kode)->firstOrFail();
        return view('pengaduan.detail_laporan', compact('pengaduan'));
    }

    public function trackingSuccess($kode)
    {
        $pengaduan = Pengaduan::where('kode_pengaduan', $kode)->firstOrFail();
        return view('pengaduan.success', compact('pengaduan'));
    }

    // Helper method untuk generate riwayat status
    private function generateRiwayatStatus($pengaduan)
    {
        $riwayat = [];
        $createdAt = Carbon::parse($pengaduan->created_at);

        // Status Diterima (selalu ada)
        $riwayat[] = [
            'status' => 'Diterima',
            'tanggal' => $createdAt->format('d September Y, H:i'), // Contoh tanggal dari Figma
            'deskripsi' => 'Pengaduan diterima oleh admin',
            'active' => true // Ini adalah status pertama yang selalu aktif
        ];

        // Status Diversifikasi (jika pengaduan sudah mencapai status ini atau lebih)
        if (in_array($pengaduan->status, ['Diversifikasi', 'Diproses', 'Selesai'])) {
            $riwayat[] = [
                'status' => 'Diversifikasi',
                'tanggal' => $createdAt->copy()->addDay()->format('d September Y, H:i'), // Contoh 1 hari setelah diterima
                'deskripsi' => 'Pengaduan sedang diverifikasi',
                'active' => in_array($pengaduan->status, ['Diversifikasi', 'Diproses', 'Selesai'])
            ];
        }

        // Status Diproses (jika pengaduan sudah mencapai status ini atau lebih)
        if (in_array($pengaduan->status, ['Diproses', 'Selesai'])) {
            $riwayat[] = [
                'status' => 'Diproses',
                'tanggal' => $createdAt->copy()->addDays(2)->format('d September Y, H:i'), // Contoh 2 hari setelah diterima
                'deskripsi' => 'Pengaduan sedang diproses',
                'active' => in_array($pengaduan->status, ['Diproses', 'Selesai'])
            ];
        }

        // Status Selesai (jika pengaduan sudah selesai)
        if ($pengaduan->status == 'Selesai') {
            $riwayat[] = [
                'status' => 'Selesai',
                'tanggal' => $createdAt->copy()->addDays(3)->format('d September Y, H:i'), // Contoh 3 hari setelah diterima
                'deskripsi' => 'Selesai',
                'active' => true // Status selesai selalu aktif jika tercapai
            ];
        } else if ($pengaduan->status == 'Diterima' || $pengaduan->status == 'Menunggu Diproses') {
            // Jika status masih Diterima, tambahkan placeholder untuk status selanjutnya
            $riwayat[] = [
                'status' => 'Diversifikasi',
                'tanggal' => null, // Belum ada tanggal
                'deskripsi' => 'Menunggu diverifikasi',
                'active' => false
            ];
            $riwayat[] = [
                'status' => 'Diproses',
                'tanggal' => null,
                'deskripsi' => 'Menunggu diproses',
                'active' => false
            ];
            $riwayat[] = [
                'status' => 'Selesai',
                'tanggal' => null,
                'deskripsi' => 'Menunggu selesai',
                'active' => false
            ];
        }


        // Ini adalah contoh sederhana. Di aplikasi nyata, Anda akan memiliki kolom `status_id`
        // dan tabel `status_logs` yang menyimpan timestamp dan status_id setiap kali status berubah.
        // Kemudian Anda akan mengambil data dari `status_logs` dan mengurutkannya.

        return $riwayat;
    }
}
