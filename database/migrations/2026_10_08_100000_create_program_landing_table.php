<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramLandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_landing', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();          /* identitas halaman, mis. budaya */
            $table->string('badge_text', 100)->nullable();  /* teks badge di atas logo, mis. 3 Program Unggulan */
            $table->string('logo_image', 255)->nullable();  /* logo bulat program */
            $table->string('title', 255)->nullable();       /* judul besar, mis. Budaya */
            $table->string('tagline', 255)->nullable();     /* sub judul, mis. Bangun Peradaban, Berakhlak & Berkarya */
            $table->text('description')->nullable();        /* paragraf deskripsi */
            $table->string('background_image', 255)->nullable(); /* foto latar hero */
            $table->integer('order')->default(0);           /* urutan tampil */
            $table->string('status', 1)->default('A');      /* A = aktif, N = nonaktif */
            $table->string('create_user', 100)->nullable();
            $table->string('update_user', 100)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_landing');
    }
}
