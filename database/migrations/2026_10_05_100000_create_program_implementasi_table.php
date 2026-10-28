<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramImplementasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_implementasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program', 255);
            $table->string('logo_image', 255)->nullable();
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
        Schema::dropIfExists('program_implementasi');
    }
}
