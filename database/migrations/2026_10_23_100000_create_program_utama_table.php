<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramUtamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_utama', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program', 150);
            $table->string('slug', 150)->unique();
            $table->string('logo_image', 255)->nullable();
            $table->string('create_user', 100)->nullable();
            $table->string('update_user', 100)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('update_date')->nullable();
        });

        $now = date('Y-m-d H:i:s');
        $defaults = [
            ['nama_program' => 'Budaya', 'slug' => 'budaya', 'logo_image' => 'website/assets/images/custom/budaya.png'],
            ['nama_program' => 'Cinta',  'slug' => 'cinta',  'logo_image' => 'website/assets/images/custom/cinta.png'],
            ['nama_program' => 'Senyum', 'slug' => 'senyum', 'logo_image' => 'website/assets/images/custom/senyum.png'],
        ];

        foreach ($defaults as $row) {
            $row['create_user'] = 'Administrator';
            $row['create_date'] = $now;
            \DB::table('program_utama')->insert($row);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_utama');
    }
}
