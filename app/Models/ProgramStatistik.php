<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStatistik extends Model
{
    use HasFactory;

    protected $table = 'program_statistik';

    protected $fillable = [
        'program', 'program_implementasi_id', 'program_dokumentasi_id', 'icon', 'angka_nilai', 'label_judul', 'urutan',
    ];

    /* kegiatan/dokumentasi pemilik data ini (null = level program) */
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
