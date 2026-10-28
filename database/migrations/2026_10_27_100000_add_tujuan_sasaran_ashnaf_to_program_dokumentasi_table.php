<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTujuanSasaranAshnafToProgramDokumentasiTable extends Migration
{
    public function up()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->text('tujuan')->nullable()->after('gambar_url');
            $table->text('sasaran')->nullable()->after('tujuan');
            $table->text('ashnaf')->nullable()->after('sasaran');
        });
    }

    public function down()
    {
        Schema::table('program_dokumentasi', function (Blueprint $table) {
            $table->dropColumn(['tujuan', 'sasaran', 'ashnaf']);
        });
    }
}
