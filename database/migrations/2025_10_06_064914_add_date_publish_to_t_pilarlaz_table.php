<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('t_pilarlaz', function (Blueprint $table) {
            $table->timestamp('date_publish')->nullable()->after('image_upload');
        });
    }

    public function down(): void
    {
        Schema::table('t_pilarlaz', function (Blueprint $table) {
            $table->dropColumn('date_publish');
        });
    }
};
