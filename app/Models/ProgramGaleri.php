<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramGaleri extends Model
{
    use HasFactory;

    protected $table = 'program_galeri';

    protected $fillable = ['program', 'program_implementasi_id', 'program_dokumentasi_id', 'gambar_url', 'keterangan', 'alt_text', 'urutan'];

    /* kegiatan/dokumentasi pemilik galeri ini (null = level program) */
    public function dokumentasi()
    {
        return $this->belongsTo(ProgramDokumentasi::class, 'program_dokumentasi_id');
    }

    /* program implementasi induk data ini */
    public function programImplementasi()
    {
        return $this->belongsTo(ProgramImplementasi::class, 'program_implementasi_id');
    }
}
