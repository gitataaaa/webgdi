<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'image_upload', 'date_publish', 'status',
        'target_nominal', 'date_start', 'date_end', 'pic', 'contact', 'category',
        'user_verify', 'deleted_at', 'program_type', 'short_desc'
    ];
}
