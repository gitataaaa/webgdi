<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramGaleriTable extends Migration
{
    public function up()
    {
        Schema::create('program_galeri', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_url', 255)->nullable();  /* path foto yang diunggah */
            $table->string('keterangan', 255)->nullable();   /* caption di bawah foto */
            $table->string('alt_text', 255)->nullable();     /* alt text gambar */
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        $now = date('Y-m-d H:i:s');
        $defaults = [
            ['gambar_url' => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg', 'keterangan' => 'Penyaluran manfaat wakaf', 'alt_text' => 'Penyaluran manfaat wakaf untuk masyarakat', 'urutan' => 1],
            ['gambar_url' => 'images/blog/sedekah-ramadhan.jpg', 'keterangan' => 'Santunan & sedekah Ramadhan', 'alt_text' => 'Penyaluran sedekah dan wakaf di bulan Ramadhan', 'urutan' => 2],
            ['gambar_url' => 'images/blog/rice-learnreliggions-com.jpg', 'keterangan' => 'Bantuan bahan pokok dhuafa', 'alt_text' => 'Penyaluran bahan pokok untuk masyarakat dhuafa', 'urutan' => 3],
        ];
        foreach ($defaults as $row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
            \DB::table('program_galeri')->insert($row);
        }
    }

    public function down()
    {
        Schema::dropIfExists('program_galeri');
    }
}
