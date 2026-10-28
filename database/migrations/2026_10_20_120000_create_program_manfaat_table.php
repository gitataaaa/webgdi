<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramManfaatTable extends Migration
{
    public function up()
    {
        Schema::create('program_manfaat', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        $now = date('Y-m-d H:i:s');
        $defaults = [
            ['judul' => 'Pahala Jariyah Berkelanjutan', 'deskripsi' => 'Manfaat wakaf terus mengalir selama fasilitasnya digunakan masyarakat, pahalanya pun terus berjalan meski pemberi wakaf telah tiada.', 'urutan' => 1],
            ['judul' => 'Menopang Dakwah & Sosial', 'deskripsi' => 'Wakaf dan hibah Anda menopang operasional serta pengembangan program dakwah dan sosial Graha Dhuafa Indonesia.', 'urutan' => 2],
            ['judul' => 'Tepat Sasaran & Amanah', 'deskripsi' => 'Pengelolaan dilakukan secara profesional dan transparan, diprioritaskan untuk masyarakat dhuafa yang paling membutuhkan.', 'urutan' => 3],
        ];
        foreach ($defaults as $row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
            \DB::table('program_manfaat')->insert($row);
        }
    }

    public function down()
    {
        Schema::dropIfExists('program_manfaat');
    }
}
