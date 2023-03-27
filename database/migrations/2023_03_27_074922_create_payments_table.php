<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100)->nullable();
            $table->string('transcode', 100)->nullable();
            $table->string('name', 200)->nullable();
            $table->string('pronoun', 50)->nullable();
            $table->boolean('anonim')->nullable();
            $table->string('notelp', 50)->nullable();
            $table->text('email')->nullable();
            $table->float('nominal', 10, 2)->nullable();
            $table->string('payment_method', 100)->nullable();
            $table->string('bank_type', 100)->nullable();
            $table->integer('bank_id')->nullable();
            $table->string('digit', 5)->nullable();
            $table->enum('status', ['pending','on_confirm', 'complete']);
            $table->timestamp('exp_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
