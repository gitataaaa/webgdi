<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramFaqTable extends Migration
{
    public function up()
    {
        Schema::create('program_faq', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan', 255)->nullable();
            $table->text('jawaban')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        $now = date('Y-m-d H:i:s');
        $defaults = [
            ['pertanyaan' => 'Bagaimana cara mendaftar sebagai peserta?', 'jawaban' => 'Isi formulir online melalui tautan resmi yang tersedia, lengkapi data peserta, lalu unggah bukti pembayaran.', 'urutan' => 1],
            ['pertanyaan' => 'Apakah pendaftaran Tahap 3 masih dibuka?', 'jawaban' => 'Ya, pendaftaran Tahap 3 resmi dibuka mulai tanggal 08 - 09 Juli 2026 dan akan ditutup otomatis pada pukul 23:59 WIB.', 'urutan' => 2],
            ['pertanyaan' => 'Apa saja cabang lomba yang diadakan?', 'jawaban' => 'Cabang lomba meliputi Lomba Menyanyi Solo, Pantomim, Pildacil, Cerdas Cermat, Menggambar, dan Tahfiz Juz 30.', 'urutan' => 3],
            ['pertanyaan' => 'Apakah pelaksanaan lomba dilakukan secara online atau offline?', 'jawaban' => 'Beberapa cabang lomba memiliki babak penyisihan online/daring, sedangkan babak penyisihan Tahfiz dan acara final dilaksanakan secara offline.', 'urutan' => 4],
            ['pertanyaan' => 'Di mana saya bisa mendapatkan informasi/pengumuman resmi terkait lomba?', 'jawaban' => 'Pengumuman resmi dapat dicek melalui akun Instagram @event.grahadhuafa, grup WhatsApp resmi peserta, atau langsung pada halaman status pendaftaran.', 'urutan' => 5],
        ];
        foreach ($defaults as $row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
            \DB::table('program_faq')->insert($row);
        }
    }

    public function down()
    {
        Schema::dropIfExists('program_faq');
    }
}
