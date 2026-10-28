<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddProgramImplementasiIdToProgramContentTables extends Migration
{
    /**
     * Tabel konten program beserta kolom penanda programnya.
     * program_landing memakai kolom "slug", tabel lain memakai kolom "program".
     */
    private $tables = [
        'program_dokumentasi' => 'program',
        'program_statistik'   => 'program',
        'program_faq'         => 'program',
        'program_manfaat'     => 'program',
        'program_galeri'      => 'program',
        'program_landing'     => 'slug',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (array_keys($this->tables) as $table) {
            if (Schema::hasColumn($table, 'program_implementasi_id')) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->unsignedBigInteger('program_implementasi_id')->nullable()->after('id');
                $blueprint->foreign('program_implementasi_id')
                    ->references('id')->on('program_implementasi')
                    ->nullOnDelete();
            });
        }

        /* Petakan nama program implementasi ke slug yang dipakai konten program */
        $map = [];
        foreach (DB::table('program_implementasi')->get() as $implementasi) {
            $slug = Str::slug((string) $implementasi->nama_program);
            if ($slug !== '') {
                $map[$slug] = $implementasi->id;
            }
        }

        /* Isi kolom baru untuk data lama yang programnya cocok */
        if (!empty($map)) {
            foreach ($this->tables as $table => $column) {
                $rows = DB::table($table)
                    ->select('id', $column)
                    ->whereNull('program_implementasi_id')
                    ->get();

                foreach ($rows as $row) {
                    $slug = Str::slug((string) $row->{$column});
                    if ($slug === '' || !isset($map[$slug])) {
                        continue;
                    }

                    DB::table($table)->where('id', $row->id)->update([
                        'program_implementasi_id' => $map[$slug],
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (array_keys($this->tables) as $table) {
            if (!Schema::hasColumn($table, 'program_implementasi_id')) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->dropConstrainedForeignId('program_implementasi_id');
            });
        }
    }
}
