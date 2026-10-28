<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramStatistikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_statistik', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 255)->nullable();      /* emoji (❤️ 🙏 🕌 🎁 🌱), path gambar upload, atau HTML/SVG icon */
            $table->string('angka_nilai', 100)->nullable(); /* angka tampil, mis. 1000+, 3+, 100+, ∞ */
            $table->string('label_judul', 150)->nullable(); /* label, mis. WAKIF & DONATUR */
            $table->integer('urutan')->default(0);          /* posisi tampil kotak */
            $table->timestamps();
        });

        /* data default agar tampilan frontend tidak kosong setelah migrasi */
        $now = date('Y-m-d H:i:s');
        $defaults = [
            ['icon' => '🤲', 'angka_nilai' => '1000+', 'label_judul' => 'WAKIF & DONATUR', 'urutan' => 1],
            ['icon' => '🕌', 'angka_nilai' => '3+',    'label_judul' => 'PROGRAM TERBANTU', 'urutan' => 2],
            ['icon' => '🎁', 'angka_nilai' => '100+',  'label_judul' => 'PENYALURAN WAKAF', 'urutan' => 3],
            ['icon' => '🌱', 'angka_nilai' => '∞',     'label_judul' => 'PAHALA BERKELANJUTAN', 'urutan' => 4],
        ];
        foreach ($defaults as $row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
            \DB::table('program_statistik')->insert($row);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_statistik');
    }
}
