<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramDonasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id', 'ip_address', 'donatur', 'nominal',
        'date_donasi', 'media_transfer', 'account_name', 'account_no',
        'bank_name', 'bank_code', 'bank_nominal', 'status', 'deleted_at'
    ];
}
