<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramRealisasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id', 'title', 'description', 'pelaksana', 'date_realisasi', 'date_publish',
        'status', 'user_verify', 'deleted_at'
    ];
}
