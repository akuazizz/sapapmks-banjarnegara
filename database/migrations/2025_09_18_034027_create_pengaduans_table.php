<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();

            // Data Diri Pelapor
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('nik', 16)->unique(); // NIK harus unik dan 16 digit
            $table->string('nomor_kk', 16)->nullable();
            $table->string('desil_dtsen')->nullable();
            $table->string('no_kis_bpjs')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat_ktp');
            $table->text('alamat_domisili')->nullable();

            // Data Pelapor & Pengaduan
            $table->string('nama_pelapor');
            $table->string('nomor_hp_pelapor', 20);
            $table->string('email_pelapor')->nullable();
            $table->string('pekerjaan_pelapor')->nullable();
            $table->string('jenis_pmks');
            $table->text('isi_aduan');
            $table->string('jenis_bantuan');
            $table->string('kondisi_ekonomi_pmks')->nullable();
            $table->string('kondisi_sosial_pmks')->nullable();
            $table->string('foto_pmks_path')->nullable(); // Path untuk menyimpan nama file gambar

            // Tambahan untuk status atau informasi lainnya
            $table->string('status')->default('Menunggu Diproses'); // Contoh: Menunggu Diproses, Sedang Diproses, Selesai
            $table->timestamp('tanggal_laporan')->useCurrent(); // Otomatis terisi saat dibuat

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
}
