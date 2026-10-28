<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDokumentasi extends Model
{
    use HasFactory;

    protected $table = 'program_dokumentasi';

    protected $fillable = [
        'program',
        'program_implementasi_id',
        'kategori_badge',
        'judul_kegiatan',
        'gambar_url',
        'tujuan',
        'sasaran',
        'ashnaf',
        'link_detail',
        'youtube_url',
        'deskripsi_video',
        'tujuan_sasaran_ansaf',
        'urutan',
    ];

    /* program implementasi induk data ini */
    public function programImplementasi()
    {
        return $this->belongsTo(ProgramImplementasi::class, 'program_implementasi_id');
    }
}