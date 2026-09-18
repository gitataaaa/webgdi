<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus';

    protected $fillable = [
        'title', 'subtitle', 'parent_id', 'menu_type', 'page_type', 'content', 'slug',
        'order', 'status_display', 'url', 'footer_display', 'featured_img',
        'user_verify' 
    ];
}
