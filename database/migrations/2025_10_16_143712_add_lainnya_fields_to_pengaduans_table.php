<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('jenis_pmks_lainnya')->nullable()->after('jenis_pmks');
            $table->string('jenis_bantuan_lainnya')->nullable()->after('jenis_bantuan');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['jenis_pmks_lainnya', 'jenis_bantuan_lainnya']);
        });
    }
};
