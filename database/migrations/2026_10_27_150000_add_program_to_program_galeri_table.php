<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddProgramToProgramGaleriTable extends Migration
{
    public function up()
    {
        Schema::table('program_galeri', function (Blueprint $table) {
            $table->string('program', 50)->nullable()->after('id')->index();
            /* NULL = galeri level program, terisi = galeri khusus satu kegiatan/dokumentasi */
            $table->unsignedBigInteger('program_dokumentasi_id')->nullable()->after('program')->index();
        });

        /* data lama diarahkan ke program pertama sebagai galeri level program */
        $default = DB::table('program_utama')->orderBy('id')->value('slug') ?: 'budaya';
        DB::table('program_galeri')->whereNull('program')->update(['program' => $default]);
    }

    public function down()
    {
        Schema::table('program_galeri', function (Blueprint $table) {
            $table->dropColumn(['program', 'program_dokumentasi_id']);
        });
    }
}
