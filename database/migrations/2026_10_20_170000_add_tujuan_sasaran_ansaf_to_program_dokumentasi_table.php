<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTujuanSasaranAnsafToProgramDokumentasiTable extends Migration
{
    public function up()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->text('tujuan_sasaran_ansaf')->nullable()->after('deskripsi_video'); /* Tujuan & sasaran program (Ansaf) */
        });
    }

    public function down()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->dropColumn('tujuan_sasaran_ansaf');
        });
    }
}
