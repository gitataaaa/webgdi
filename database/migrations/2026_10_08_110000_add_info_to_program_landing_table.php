<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToProgramLandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_landing', function (Blueprint $table) {
            /* teks "Informasi" di bawah nama program + tagline */
            $table->text('info_text')->nullable()->after('description');

            /* isi tambahan ala kartu program utama di wakaf: JSON list {icon, title, desc} */
            $table->longText('info_items')->nullable()->after('info_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_landing', function (Blueprint $table) {
            $table->dropColumn(['info_text', 'info_items']);
        });
    }
}
