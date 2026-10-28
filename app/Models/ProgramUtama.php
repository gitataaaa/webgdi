<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUtama extends Model
{
    use HasFactory;

    protected $table = 'program_utama';

    protected $fillable = [
        'nama_program',
        'slug',
        'logo_image',
        'create_user',
        'update_user',
        'create_date',
        'update_date',
    ];

    public $timestamps = false;

    protected $casts = [
        'create_date' => 'datetime',
        'update_date' => 'datetime',
    ];

    /* daftar program induk: [slug => nama_program] */
    public static function options()
    {
        $programs = static::orderBy('id')->pluck('nama_program', 'slug')->toArray();

        return $programs ?: [
            'budaya' => 'Budaya',
            'cinta'  => 'Cinta',
            'senyum' => 'Senyum',
        ];
    }

    /* pastikan slug program valid, jika tidak kembali ke program pertama */
    public static function resolveSlug($slug)
    {
        $programs = static::options();

        if (!$slug || !isset($programs[$slug])) {
            $slug = array_key_exists('budaya', $programs) ? 'budaya' : array_key_first($programs);
        }

        return $slug;
    }
}
