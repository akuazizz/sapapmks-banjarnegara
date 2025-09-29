<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'nik',
        'nomor_kk',
        'desil_dtsen',
        'no_kis_bpjs',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_ktp',
        'alamat_domisili',
        'nama_pelapor',
        'nomor_hp_pelapor',
        'email_pelapor',
        'pekerjaan_pelapor',
        'jenis_pmks',
        'isi_aduan',
        'jenis_bantuan',
        'kondisi_ekonomi_pmks',
        'kondisi_sosial_pmks',
        'foto_pmks_path',
        'status',
        'tanggal_laporan',
        'alasan_penolakan',
    ];

    // Jika Anda ingin menonaktifkan created_at dan updated_at, Anda bisa:
    // public $timestamps = false;
    // Tapi disarankan untuk tetap menggunakan timestamps.
}
