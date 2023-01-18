<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('slug')->nullable();
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->mediumText('image_upload')->nullable();
            $table->timestamp('date_publish')->nullable();
            $table->enum('status', ['draft', 'publish'])->nullable();
            $table->float('target_nominal')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('pic')->nullable();
            $table->string('contact')->nullable();
            $table->string('category')->nullable();
            $table->enum('program_type', ['donation', 'non-donation'])->nullable();
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
        Schema::dropIfExists('programs');
    }
}
