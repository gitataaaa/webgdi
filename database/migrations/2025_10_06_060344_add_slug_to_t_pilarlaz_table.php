<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToTPilarlazTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('t_pilarlaz', function (Blueprint $table) {
        $table->string('slug')->after('nama_program')->nullable();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
 public function down()
{
    Schema::table('t_pilarlaz', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}
}
