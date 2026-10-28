<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramLanding;

class ProgramLandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Data awal hero halaman pilar program */
        $data = [
            [
                'slug'             => 'budaya',
                'badge_text'       => '3 Program Unggulan',
                'logo_image'       => 'website/assets/images/custom/budaya.png',
                'title'            => 'Budaya',
                'tagline'          => 'Bangun Peradaban, Berakhlak & Berkarya',
                'description'      => "Merupakan program yang berkonsentrasi pada pembangunan lingkungan\nuntuk memunculkan generasi yang kreatif, penuh karya dan Qur'ani.",
                'info_text'        => 'Program Budaya menampung tiga pilar kegiatan utama: pendanaan wakaf & hibah, qurban tahunan, dan event dakwah untuk generasi muda.',
                'info_items'       => [
                    [
                        'icon'  => 'gift',
                        'title' => 'Wakaf & Hibah',
                        'desc'  => 'Salurkan wakaf dan hibah terbaik Anda untuk menopang program dakwah & sosial.',
                    ],
                    [
                        'icon'  => 'moon',
                        'title' => 'Peace Qurban',
                        'desc'  => 'Penyaluran hewan kurban dan olahan dagingnya sampai ke masyarakat dhuafa.',
                    ],
                    [
                        'icon'  => 'megaphone',
                        'title' => 'Bandung Berzikir',
                        'desc'  => 'Event zikir & kajian massal bagi generasi muda Bandung.',
                    ],
                ],
                'background_image' => 'website/assets/images/backgrounds/page-header-bg-3.jpeg',
                'order'            => 1,
                'status'           => 'A',
            ],
            [
                'slug'             => 'cinta',
                'badge_text'       => '3 Program Unggulan',
                'logo_image'       => 'website/assets/images/custom/cinta.png',
                'title'            => 'Cinta',
                'tagline'          => "Cinta Yatim, Cinta Al-Qur'an, Cinta Negeri",
                'description'      => "Program yang berfokus pada pembinaan anak yatim, dhuafa, dan tahfidz melalui beasiswa, pendidikan Al-Qur'an, serta kegiatan penuh kasih sayang untuk menumbuhkan generasi Qur'ani.",
                'info_text'        => 'Program Cinta menaungi kegiatan kepedulian dan pendidikan: Zooerney Cinta Yatim, Graha Tahfidz, serta Beasiswa & Santunan.',
                'info_items'       => [
                    [
                        'icon'  => 'people',
                        'title' => 'Zooerney Cinta Yatim',
                        'desc'  => 'Rekreasi dan edukasi bersama anak yatim & dhuafa.',
                    ],
                    [
                        'icon'  => 'book',
                        'title' => 'Graha Tahfidz',
                        'desc'  => "Pembinaan hafalan Al-Qur'an bagi generasi muda.",
                    ],
                    [
                        'icon'  => 'star',
                        'title' => 'Beasiswa & Santunan',
                        'desc'  => 'Dukungan pendidikan dan santunan bagi anak yatim & dhuafa.',
                    ],
                ],
                'background_image' => 'website/assets/images/backgrounds/page-header-bg-3.jpeg',
                'order'            => 2,
                'status'           => 'A',
            ],
            [
                'slug'             => 'senyum',
                'badge_text'       => '3 Program Unggulan',
                'logo_image'       => 'website/assets/images/custom/senyum.png',
                'title'            => 'Senyum',
                'tagline'          => 'Berbagi Kebahagiaan, Menghadirkan Harapan',
                'description'      => 'Program kepedulian sosial dan kemanusiaan yang menghadirkan senyum bagi masyarakat dhuafa melalui santunan, paket sembako, Jumat berbagi, serta respons cepat terhadap kebutuhan darurat.',
                'info_text'        => 'Program Senyum menaungi kegiatan sosial: Jumat Berbagi, Santunan Anak Yatim & Dhuafa, serta Paket Sembako Dhuafa.',
                'info_items'       => [
                    [
                        'icon'  => 'gift',
                        'title' => 'Jumat Berbagi',
                        'desc'  => 'Berbagi paket kebaikan setiap Jumat untuk masyarakat dhuafa.',
                    ],
                    [
                        'icon'  => 'hands',
                        'title' => 'Santunan Anak Yatim & Dhuafa',
                        'desc'  => 'Meringankan beban keluarga dhuafa dengan santunan rutin.',
                    ],
                    [
                        'icon'  => 'home',
                        'title' => 'Paket Sembako Dhuafa',
                        'desc'  => 'Kebutuhan pokok untuk keluarga prasejahtera.',
                    ],
                ],
                'background_image' => 'website/assets/images/backgrounds/page-header-bg-3.jpeg',
                'order'            => 3,
                'status'           => 'A',
            ],
        ];

        foreach ($data as $row) {
            ProgramLanding::updateOrCreate(['slug' => $row['slug']], $row);
        }
    }
}
