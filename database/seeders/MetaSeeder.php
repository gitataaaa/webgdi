<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metas')->insert([
            'var' => 'INST_LOGO',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'INST_NAME',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'INST_TELP',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'INST_ADDR',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'INST_EMAIL',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'GOO_APP_CKEY',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'GOO_APP_SKEY',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'EM_USER',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'EM_PASS',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'EM_SMTP',
            'status' => 'A',
        ]);
        DB::table('metas')->insert([
            'var' => 'EM_PORT',
            'status' => 'A',
        ]);
    }
}
