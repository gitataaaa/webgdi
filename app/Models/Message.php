<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email', 'sender', 'subject', 'content', 'date_send', 'status',
        'user_verify', 'deleted_at'
    ];
}
