<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengaduanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $status;
    protected $tanggal;

    // Tambahkan constructor untuk menerima filter
    public function __construct($status = null, $tanggal = null)
    {
        $this->status = $status;
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = Pengaduan::query();

        // Jika filter status dikirim dan bukan "semua"
        if ($this->status && $this->status !== 'semua') {
            $query->where('status', $this->status);
        }

        // Jika filter tanggal dikirim
        if ($this->tanggal) {
            $query->whereDate('created_at', $this->tanggal);
        }

        $pengaduans = $query->get();

        return $pengaduans->map(function ($pengaduan) {
            return [
                'Kode Pengaduan' => $pengaduan->kode_pengaduan,
                'Tanggal Laporan' => $pengaduan->tanggal_laporan,
                'Status' => $pengaduan->status,
                'Jenis PMKS' => $pengaduan->jenis_pmks,
                'Nama PMKS' => $pengaduan->nama,
                'NIK PMKS' => "'" . $pengaduan->nik, // agar tidak berubah jadi 3.304E+15
                'Alamat Domisili' => $pengaduan->alamat_domisili,
                'Jenis Bantuan' => $pengaduan->jenis_bantuan,
                'Kondisi Ekonomi' => $pengaduan->kondisi_ekonomi_pmks,
                'Kondisi Sosial' => $pengaduan->kondisi_sosial_pmks,
                'Isi Aduan' => $pengaduan->isi_aduan,
                'Nama Pelapor' => $pengaduan->nama_pelapor,
                'HP Pelapor' => "'" . $pengaduan->nomor_hp_pelapor,
                'Alasan Ditolak' => $pengaduan->alasan_penolakan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Pengaduan',
            'Tanggal Laporan',
            'Status',
            'Jenis PMKS',
            'Nama PMKS',
            'NIK PMKS',
            'Alamat Domisili',
            'Jenis Bantuan',
            'Kondisi Ekonomi',
            'Kondisi Sosial',
            'Isi Aduan',
            'Nama Pelapor',
            'HP Pelapor',
            'Alasan Ditolak',
        ];
    }
}
