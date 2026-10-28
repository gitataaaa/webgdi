<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYoutubeUrlToProgramManfaatTable extends Migration
{
    public function up()
    {
        Schema::table('program_manfaat', function (Blueprint $table) {
            $table->string('youtube_url', 255)->nullable()->after('deskripsi'); /* URL video YouTube manfaat */
        });
    }

    public function down()
    {
        Schema::table('program_manfaat', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
        });
    }
}
