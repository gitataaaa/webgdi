<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCintaSenyumProgramContent extends Migration
{
    /**
     * Isi awal halaman Cinta & Senyum.
     * Hanya menambah data yang belum ada agar konten yang sudah diubah admin tidak tertimpa.
     *
     * @return void
     */
    public function up()
    {
        $now = date('Y-m-d H:i:s');

        $landings = [
            [
                'slug'             => 'cinta',
                'badge_text'       => '3 Program Unggulan',
                'logo_image'       => 'website/assets/images/custom/cinta.png',
                'title'            => 'Cinta',
                'tagline'          => 'Cinta Yatim, Cinta Al-Qur\'an, Cinta Negeri',
                'description'      => "Program yang berfokus pada pembinaan anak yatim, dhuafa, dan tahfidz melalui beasiswa, pendidikan Al-Qur'an, serta kegiatan penuh kasih sayang untuk menumbuhkan generasi Qur'ani.",
                'info_text'        => 'Program Cinta menaungi kegiatan kepedulian dan pendidikan: Zooerney Cinta Yatim, Graha Tahfidz, serta Beasiswa & Santunan.',
                'background_image' => 'website/assets/images/backgrounds/page-header-bg-3.jpeg',
                'order'            => 2,
            ],
            [
                'slug'             => 'senyum',
                'badge_text'       => '3 Program Unggulan',
                'logo_image'       => 'website/assets/images/custom/senyum.png',
                'title'            => 'Senyum',
                'tagline'          => 'Berbagi Kebahagiaan, Menghadirkan Harapan',
                'description'      => 'Program kepedulian sosial dan kemanusiaan yang menghadirkan senyum bagi masyarakat dhuafa melalui santunan, paket sembako, Jumat berbagi, serta respons cepat terhadap kebutuhan darurat.',
                'info_text'        => 'Program Senyum menaungi kegiatan sosial: Jumat Berbagi, Santunan Anak Yatim & Dhuafa, serta Paket Sembako Dhuafa.',
                'background_image' => 'website/assets/images/backgrounds/page-header-bg-3.jpeg',
                'order'            => 3,
            ],
        ];

        $infoItems = [
            'cinta' => [
                ['icon' => 'people', 'title' => 'Zooerney Cinta Yatim', 'desc' => 'Rekreasi dan edukasi bersama anak yatim & dhuafa.'],
                ['icon' => 'book',   'title' => 'Graha Tahfidz',       'desc' => 'Pembinaan hafalan Al-Qur\'an bagi generasi muda.'],
                ['icon' => 'star',   'title' => 'Beasiswa & Santunan', 'desc' => 'Dukungan pendidikan dan santunan bagi anak yatim & dhuafa.'],
            ],
            'senyum' => [
                ['icon' => 'gift',   'title' => 'Jumat Berbagi',               'desc' => 'Berbagi paket kebaikan setiap Jumat untuk masyarakat dhuafa.'],
                ['icon' => 'hands',  'title' => 'Santunan Anak Yatim & Dhuafa', 'desc' => 'Meringankan beban keluarga dhuafa dengan santunan rutin.'],
                ['icon' => 'home',   'title' => 'Paket Sembako Dhuafa',        'desc' => 'Kebutuhan pokok untuk keluarga prasejahtera.'],
            ],
        ];

        foreach ($landings as $landing) {
            if (DB::table('program_landing')->where('slug', $landing['slug'])->exists()) {
                continue;
            }

            $landing['info_items']  = json_encode($infoItems[$landing['slug']]);
            $landing['status']      = 'A';
            $landing['create_user'] = 'Administrator';
            $landing['create_date'] = $now;

            DB::table('program_landing')->insert($landing);
        }

        $dokumentasi = [
            'cinta' => [
                ['kategori_badge' => 'PENDIDIKAN', 'judul_kegiatan' => 'Zooerney Cinta Yatim',        'gambar_url' => 'images/blog/2e10e7a278d7e5b7b0bf939a2399f97a.jpg', 'link_detail' => '/cinta'],
                ['kategori_badge' => 'TAHFIDZ',    'judul_kegiatan' => 'Graha Tahfidz',                'gambar_url' => 'images/blog/qiyamullail.jpg',                      'link_detail' => '/cinta'],
                ['kategori_badge' => 'BEASISWA',   'judul_kegiatan' => 'Beasiswa & Santunan Yatim',    'gambar_url' => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg', 'link_detail' => '/cinta'],
            ],
            'senyum' => [
                ['kategori_badge' => 'SOSIAL',       'judul_kegiatan' => 'Jumat Berbagi',                 'gambar_url' => 'images/blog/rice-learnreliggions-com.jpg',        'link_detail' => '/senyum'],
                ['kategori_badge' => 'SANTUNAN',     'judul_kegiatan' => 'Santunan Anak Yatim & Dhuafa',  'gambar_url' => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg', 'link_detail' => '/senyum'],
                ['kategori_badge' => 'KEMANUSIAAN',  'judul_kegiatan' => 'Paket Sembako Dhuafa',          'gambar_url' => 'images/blog/sedekah-ramadhan.jpg',                'link_detail' => '/senyum'],
            ],
        ];

        foreach ($dokumentasi as $program => $items) {
            if (DB::table('program_dokumentasi')->where('program', $program)->exists()) {
                continue;
            }

            foreach ($items as $index => $item) {
                $item['program']    = $program;
                $item['urutan']     = $index + 1;
                $item['created_at'] = $now;
                $item['updated_at'] = $now;

                DB::table('program_dokumentasi')->insert($item);
            }
        }

        /* jadikan tile homepage Cinta & Senyum bisa diklik */
        DB::table('program_implementasi')->where('nama_program', 'Cinta')->update(['url_program' => '/cinta']);
        DB::table('program_implementasi')->where('nama_program', 'Senyum')->update(['url_program' => '/senyum']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('program_dokumentasi')->whereIn('program', ['cinta', 'senyum'])->delete();
        DB::table('program_landing')->whereIn('slug', ['cinta', 'senyum'])->delete();
        DB::table('program_implementasi')->where('nama_program', 'Cinta')->update(['url_program' => null]);
        DB::table('program_implementasi')->where('nama_program', 'Senyum')->update(['url_program' => null]);
    }
}
