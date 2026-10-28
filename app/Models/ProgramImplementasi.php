<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramImplementasi extends Model
{
    use HasFactory;

    protected $table = 'program_implementasi';

    protected $fillable = [
        'nama_program',
        'logo_image',
        'url_program',
        'create_user',
        'update_user',
        'create_date',
        'update_date',
    ];

    public $timestamps = false;

    /* cari id program implementasi dari slug/nama program (mis. "budaya" => 1) */
    public static function idForProgram($program)
    {
        $slug = Str::slug((string) $program);
        if ($slug === '') {
            return null;
        }

        foreach (static::query()->get(['id', 'nama_program']) as $row) {
            if (Str::slug((string) $row->nama_program) === $slug) {
                return $row->id;
            }
        }

        return null;
    }

    protected $casts = [
        'create_date' => 'datetime',
        'update_date' => 'datetime',
    ];

    /* Relasi ke seluruh konten program yang memakai program_implementasi_id */
    public function dokumentasi()
    {
        return $this->hasMany(ProgramDokumentasi::class, 'program_implementasi_id');
    }

    public function statistik()
    {
        return $this->hasMany(ProgramStatistik::class, 'program_implementasi_id');
    }

    public function faq()
    {
        return $this->hasMany(ProgramFaq::class, 'program_implementasi_id');
    }

    public function manfaat()
    {
        return $this->hasMany(ProgramManfaat::class, 'program_implementasi_id');
    }

    public function galeri()
    {
        return $this->hasMany(ProgramGaleri::class, 'program_implementasi_id');
    }

    public function landing()
    {
        return $this->hasMany(ProgramLanding::class, 'program_implementasi_id');
    }
}
