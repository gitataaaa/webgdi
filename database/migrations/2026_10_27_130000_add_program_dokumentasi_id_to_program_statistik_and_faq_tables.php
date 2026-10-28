<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgramDokumentasiIdToProgramStatistikAndFaqTables extends Migration
{
    public function up()
    {
        /* NULL = data level program, terisi = data khusus satu kegiatan/dokumentasi */
        Schema::table('program_statistik', function (Blueprint $table) {
            $table->unsignedBigInteger('program_dokumentasi_id')->nullable()->after('program')->index();
        });

        Schema::table('program_faq', function (Blueprint $table) {
            $table->unsignedBigInteger('program_dokumentasi_id')->nullable()->after('program')->index();
        });
    }

    public function down()
    {
        Schema::table('program_statistik', function (Blueprint $table) {
            $table->dropColumn('program_dokumentasi_id');
        });

        Schema::table('program_faq', function (Blueprint $table) {
            $table->dropColumn('program_dokumentasi_id');
        });
    }
}
