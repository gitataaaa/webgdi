<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_donasis', function (Blueprint $table) {
            $table->id();
            $table->integer('program_id');
            $table->string('ip_address')->nullable();
            $table->string('donatur')->nullable();
            $table->float('nominal', 20, 5)->nullable();
            $table->datetime('date_donasi')->nullable();
            $table->string('media_transfer')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->float('bank_nominal', 20, 5)->nullable();
            $table->enum('status', ['success', 'failed'])->nullable();
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
        Schema::dropIfExists('program_donasis');
    }
}
