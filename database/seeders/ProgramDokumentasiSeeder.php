<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramDokumentasi;

class ProgramDokumentasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Data awal dokumentasi kegiatan per halaman program */
        $items = [
            /* Budaya */
            [
                'program'        => 'budaya',
                'kategori_badge' => 'WAKAF',
                'judul_kegiatan' => 'Wakaf & Hibah',
                'gambar_url'     => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg',
                'link_detail'    => '/wakaf-hibah',
                'urutan'         => 1,
            ],
            [
                'program'        => 'budaya',
                'kategori_badge' => 'QURBAN',
                'judul_kegiatan' => 'Peace Qurban',
                'gambar_url'     => 'images/blog/wow.jpeg',
                'link_detail'    => '/budaya',
                'urutan'         => 2,
            ],
            [
                'program'        => 'budaya',
                'kategori_badge' => 'DAKWAH',
                'judul_kegiatan' => 'Bandung Berzikir',
                'gambar_url'     => 'images/blog/qiyamullail.jpg',
                'link_detail'    => '/budaya',
                'urutan'         => 3,
            ],
            [
                'program'        => 'budaya',
                'kategori_badge' => 'SEDEKAH',
                'judul_kegiatan' => 'Sedekah Ramadhan',
                'gambar_url'     => 'images/blog/sedekah-ramadhan.jpg',
                'link_detail'    => '/wakaf-hibah',
                'urutan'         => 4,
            ],
            [
                'program'        => 'budaya',
                'kategori_badge' => 'SOSIAL',
                'judul_kegiatan' => 'Bantuan Bahan Pokok Dhuafa',
                'gambar_url'     => 'images/blog/rice-learnreliggions-com.jpg',
                'link_detail'    => '/wakaf-hibah',
                'urutan'         => 5,
            ],
            [
                'program'        => 'budaya',
                'kategori_badge' => 'PENDIDIKAN',
                'judul_kegiatan' => 'Pembinaan Generasi Muda',
                'gambar_url'     => 'images/blog/2e10e7a278d7e5b7b0bf939a2399f97a.jpg',
                'link_detail'    => '/budaya',
                'urutan'         => 6,
            ],

            /* Cinta */
            [
                'program'        => 'cinta',
                'kategori_badge' => 'PENDIDIKAN',
                'judul_kegiatan' => 'Zooerney Cinta Yatim',
                'gambar_url'     => 'images/blog/2e10e7a278d7e5b7b0bf939a2399f97a.jpg',
                'link_detail'    => '/cinta',
                'urutan'         => 1,
            ],
            [
                'program'        => 'cinta',
                'kategori_badge' => 'TAHFIDZ',
                'judul_kegiatan' => 'Graha Tahfidz',
                'gambar_url'     => 'images/blog/qiyamullail.jpg',
                'link_detail'    => '/cinta',
                'urutan'         => 2,
            ],
            [
                'program'        => 'cinta',
                'kategori_badge' => 'BEASISWA',
                'judul_kegiatan' => 'Beasiswa & Santunan Yatim',
                'gambar_url'     => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg',
                'link_detail'    => '/cinta',
                'urutan'         => 3,
            ],

            /* Senyum */
            [
                'program'        => 'senyum',
                'kategori_badge' => 'SOSIAL',
                'judul_kegiatan' => 'Jumat Berbagi',
                'gambar_url'     => 'images/blog/rice-learnreliggions-com.jpg',
                'link_detail'    => '/senyum',
                'urutan'         => 1,
            ],
            [
                'program'        => 'senyum',
                'kategori_badge' => 'SANTUNAN',
                'judul_kegiatan' => 'Santunan Anak Yatim & Dhuafa',
                'gambar_url'     => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg',
                'link_detail'    => '/senyum',
                'urutan'         => 2,
            ],
            [
                'program'        => 'senyum',
                'kategori_badge' => 'KEMANUSIAAN',
                'judul_kegiatan' => 'Paket Sembako Dhuafa',
                'gambar_url'     => 'images/blog/sedekah-ramadhan.jpg',
                'link_detail'    => '/senyum',
                'urutan'         => 3,
            ],
        ];

        foreach ($items as $item) {
            ProgramDokumentasi::updateOrCreate(
                ['program' => $item['program'], 'judul_kegiatan' => $item['judul_kegiatan']],
                $item
            );
        }
    }
}
