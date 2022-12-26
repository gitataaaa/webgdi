<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('page_type', ['page', 'url'])->nullable();
            $table->text('url')->nullable();
            $table->text('slug')->nullable();
            $table->text('content')->nullable();
            $table->mediumText('featured_img')->nullable();
            $table->string('kategori')->nullable();
            $table->enum('status', ['draft', 'publish'])->nullable();
            $table->string('author')->nullable();
            $table->timestamp('date_publish')->nullable();
            $table->text('hashtag')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
