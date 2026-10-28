<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlProgramToProgramImplementasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_implementasi', function (Blueprint $table) {
            $table->string('url_program', 255)->nullable()->after('logo_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_implementasi', function (Blueprint $table) {
            $table->dropColumn('url_program');
        });
    }
}
