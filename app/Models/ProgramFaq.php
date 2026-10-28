<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFaq extends Model
{
    use HasFactory;

    protected $table = 'program_faq';

    protected $fillable = ['program', 'program_implementasi_id', 'program_dokumentasi_id', 'pertanyaan', 'jawaban', 'urutan'];

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
