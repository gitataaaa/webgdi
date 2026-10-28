<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddProgramToProgramStatistikAndFaqTables extends Migration
{
    public function up()
    {
        Schema::table('program_statistik', function (Blueprint $table) {
            $table->string('program', 50)->nullable()->after('id')->index();
        });

        Schema::table('program_faq', function (Blueprint $table) {
            $table->string('program', 50)->nullable()->after('id')->index();
        });

        /* data lama yang belum terikat program diarahkan ke program pertama */
        $default = DB::table('program_utama')->orderBy('id')->value('slug') ?: 'budaya';
        DB::table('program_statistik')->whereNull('program')->update(['program' => $default]);
        DB::table('program_faq')->whereNull('program')->update(['program' => $default]);
    }

    public function down()
    {
        Schema::table('program_statistik', function (Blueprint $table) {
            $table->dropColumn('program');
        });

        Schema::table('program_faq', function (Blueprint $table) {
            $table->dropColumn('program');
        });
    }
}
