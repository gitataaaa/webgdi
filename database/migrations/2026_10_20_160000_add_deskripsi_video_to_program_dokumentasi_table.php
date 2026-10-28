<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsiVideoToProgramDokumentasiTable extends Migration
{
    public function up()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->text('deskripsi_video')->nullable()->after('youtube_url'); /* Deskripsi untuk video YouTube */
        });
    }

    public function down()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->dropColumn('deskripsi_video');
        });
    }
}
