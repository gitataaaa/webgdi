<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramDokumentasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_dokumentasi', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_badge', 100)->nullable();  /* label badge, mis. WAKAF, QURBAN, DAKWAH */
            $table->string('judul_kegiatan', 255)->nullable();  /* judul kartu, mis. Wakaf & Hibah */
            $table->string('gambar_url', 255)->nullable();      /* path foto yang diunggah */
            $table->string('link_detail', 255)->nullable();     /* URL tujuan tombol "LIHAT DETAIL KEGIATAN" */
            $table->integer('urutan')->default(0);              /* posisi tampil */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_dokumentasi');
    }
}