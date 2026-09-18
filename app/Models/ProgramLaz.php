<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramLaz extends Model
{
    use HasFactory;

    protected $table = 't_pilarlaz';

    protected $fillable = [
        'nama_program',
        'url_program', // ✅ ganti dari slug
        'description',
        'image_upload',
        'date_publish',
        'status',
    ];
}
