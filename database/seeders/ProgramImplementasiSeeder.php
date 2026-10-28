<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramImplementasi;

class ProgramImplementasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_program' => 'Budaya',
                'logo_image'   => 'images/program-implementasi/budaya.png',
                'url_program'  => '/budaya',
            ],
            [
                'nama_program' => 'Cinta',
                'logo_image'   => 'images/program-implementasi/cinta.png',
                'url_program'  => '/cinta',
            ],
            [
                'nama_program' => 'Senyum',
                'logo_image'   => 'images/program-implementasi/senyum.png',
                'url_program'  => '/senyum',
            ],
        ];

        foreach ($data as $row) {
            ProgramImplementasi::updateOrCreate(['nama_program' => $row['nama_program']], $row);
        }
    }
}
