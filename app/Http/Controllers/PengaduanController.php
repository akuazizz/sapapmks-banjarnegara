<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Tambahkan ini
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
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
            'jenis_pmks_lainnya' => 'nullable|max:255',
            'isi_aduan' => 'required',
            'jenis_bantuan' => 'required|max:255',
            'jenis_bantuan_lainnya' => 'nullable|max:255',
            'kondisi_ekonomi_pmks' => 'nullable|max:255',
            'kondisi_sosial_pmks' => 'nullable|max:255',
            'foto_pmks' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gabungkan nilai "lainnya" jika dipilih
        if ($request->jenis_pmks == 'Lainnya' && $request->filled('jenis_pmks_lainnya')) {
            $validatedData['jenis_pmks'] = $request->jenis_pmks_lainnya;
        }
        if ($request->jenis_bantuan == 'Lainnya' && $request->filled('jenis_bantuan_lainnya')) {
            $validatedData['jenis_bantuan'] = $request->jenis_bantuan_lainnya;
        }

        // Upload foto jika ada
        if ($request->hasFile('foto_pmks')) {
            $validatedData['foto_pmks_path'] = $request->file('foto_pmks')->store('foto_pmks', 'public');
        }

        // Set default status dan tanggal
        $validatedData['status'] = 'Diterima';
        $validatedData['tanggal_laporan'] = now();

        // Simpan pengaduan tanpa kode
        $pengaduan = Pengaduan::create($validatedData);

        // Buat kode unik
        $tanggalHariIni = now()->format('d-m-Y');
        $countToday = Pengaduan::whereDate('created_at', now()->toDateString())->count();
        $pengaduan->kode_pengaduan = 'PMKS-' . $tanggalHariIni . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
        $pengaduan->save();

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

        $steps = [
            'Diterima' => 'Pengaduan diterima oleh admin',
            'Diverifikasi' => 'Pengaduan sedang diverifikasi',
            'Diproses' => 'Pengaduan sedang diproses',
            'Selesai' => 'Pengaduan selesai ditindaklanjuti',
        ];

        // Jika status Ditolak, langsung return
        if ($pengaduan->status == 'Ditolak') {
            return [[
                'status' => 'Ditolak',
                'tanggal' => $createdAt->translatedFormat('d F Y, H:i'),
                'deskripsi' => 'Pengaduan ditolak. Alasan: ' . ($pengaduan->alasan_penolakan ?? '-'),
                'active' => true,
            ]];
        }

        $currentStatusIndex = array_search($pengaduan->status, array_keys($steps));

        foreach ($steps as $key => $desc) {
            $riwayat[] = [
                'status' => $key,
                'tanggal' => $createdAt->copy()->addDays(array_search($key, array_keys($steps)))->translatedFormat('d F Y, H:i'),
                'deskripsi' => $desc,
                'active' => array_search($key, array_keys($steps)) <= $currentStatusIndex
            ];
        }

        return $riwayat;
    }
}
