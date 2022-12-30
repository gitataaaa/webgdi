<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramRealisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_realisasis', function (Blueprint $table) {
            $table->id();
            $table->integer('program_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('pelaksana')->nullable();
            $table->date('date_realisasi')->nullable();
            $table->date('date_publish')->nullable();
            $table->enum('status', ['draft', 'publish'])->nullable();
            $table->string('user_verify')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_realisasis');
    }
}
