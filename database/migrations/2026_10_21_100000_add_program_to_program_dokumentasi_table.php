<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddProgramToProgramDokumentasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            /* slug halaman program pemilik dokumentasi, mis. budaya, cinta, senyum */
            $table->string('program', 100)->default('budaya')->after('id')->index();
        });

        /* dokumentasi lama dianggap milik program Budaya */
        DB::table('program_dokumentasi')
            ->whereNull('program')
            ->orWhere('program', '')
            ->update(['program' => 'budaya']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->dropColumn('program');
        });
    }
}
