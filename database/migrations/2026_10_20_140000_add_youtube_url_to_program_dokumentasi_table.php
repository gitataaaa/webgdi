<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYoutubeUrlToProgramDokumentasiTable extends Migration
{
    public function up()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->string('youtube_url', 255)->nullable()->after('link_detail'); /* URL video YouTube kegiatan */
        });
    }

    public function down()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
        });
    }
}
