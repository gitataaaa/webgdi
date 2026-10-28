<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddProgramToProgramManfaatTable extends Migration
{
    public function up()
    {
        Schema::table('program_manfaat', function (Blueprint $table) {
            $table->string('program', 50)->nullable()->after('id')->index();
            /* NULL = data level program, terisi = data khusus satu kegiatan/dokumentasi */
            $table->unsignedBigInteger('program_dokumentasi_id')->nullable()->after('program')->index();
        });

        /* data lama yang belum terikat program diarahkan ke program pertama */
        $default = DB::table('program_utama')->orderBy('id')->value('slug') ?: 'budaya';
        DB::table('program_manfaat')->whereNull('program')->update(['program' => $default]);
    }

    public function down()
    {
        Schema::table('program_manfaat', function (Blueprint $table) {
            $table->dropColumn(['program', 'program_dokumentasi_id']);
        });
    }
}
