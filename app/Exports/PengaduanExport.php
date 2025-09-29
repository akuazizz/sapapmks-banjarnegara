<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;

class PengaduanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil semua data pengaduan
        $pengaduans = Pengaduan::all();

        // Mapping data untuk kolom Excel yang rapi
        return $pengaduans->map(function ($pengaduan) {
            return [
                'Kode Pengaduan' => $pengaduan->kode_pengaduan,
                'Tanggal Laporan' => $pengaduan->tanggal_laporan,
                'Status' => $pengaduan->status,
                'Jenis PMKS' => $pengaduan->jenis_pmks,
                'Nama PMKS' => $pengaduan->nama,
                'NIK PMKS' => $pengaduan->nik,
                'Alamat Domisili' => $pengaduan->alamat_domisili,
                'Jenis Bantuan' => $pengaduan->jenis_bantuan,
                'Kondisi Ekonomi' => $pengaduan->kondisi_ekonomi_pmks,
                'Kondisi Sosial' => $pengaduan->kondisi_sosial_pmks,
                'Isi Aduan' => $pengaduan->isi_aduan,
                'Nama Pelapor' => $pengaduan->nama_pelapor,
                'HP Pelapor' => $pengaduan->nomor_hp_pelapor,
                'Alasan Ditolak' => $pengaduan->alasan_penolakan ?? '-',
            ];
        });
    }

    /**
     * Header untuk kolom Excel
     */
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