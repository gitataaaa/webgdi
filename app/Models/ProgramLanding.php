<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramLanding extends Model
{
    use HasFactory;

    protected $table = 'program_landing';

    protected $fillable = [
        'slug',
        'program_implementasi_id',
        'badge_text',
        'logo_image',
        'title',
        'tagline',
        'description',
        'info_text',
        'info_items',
        'background_image',
        'order',
        'status',
        'create_user',
        'update_user',
        'create_date',
        'update_date',
    ];

    public $timestamps = false;

    protected $casts = [
        'create_date' => 'datetime',
        'update_date' => 'datetime',
        'info_items'  => 'array',
    ];

    /* program implementasi induk data ini */
    public function programImplementasi()
    {
        return $this->belongsTo(ProgramImplementasi::class, 'program_implementasi_id');
    }
}
