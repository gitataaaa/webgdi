<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type', 'bank_name', 'bank_account', 'bank_user', 'bank_img', 'code_image', 'status',
        'deleted_at'
    ];
}
