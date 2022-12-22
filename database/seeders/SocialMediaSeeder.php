<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_media')->insert(
            [
                'var' => 'FB',
                'title' => 'Facebook',
                'icon' => 'bi-facebook',
                'classname' => null,
                'url' => 'https://facebook.com',
                'status' => 'A'
            ]
        );
        DB::table('social_media')->insert(
            [
                'var' => 'IG',
                'title' => 'Instagram',
                'icon' => 'bi-instagram',
                'classname' => null,
                'url' => 'https://instagram.com',
                'status' => 'A'
            ]
        );
        DB::table('social_media')->insert(
            [
                'var' => 'WA',
                'title' => 'Whatsapp',
                'icon' => 'bi-whatsapp',
                'classname' => null,
                'url' => 'https://whatsapp.com',
                'status' => 'A'
            ]
        );
        DB::table('social_media')->insert(
            [
                'var' => 'YT',
                'title' => 'Youtube',
                'icon' => 'bi-youtube',
                'classname' => null,
                'url' => 'https://youtube.com',
                'status' => 'A'
            ]
        );
    }
}
