<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;
    protected $fillable = [
        'tool_name',
        'tool_slug',
        'is_home',
        'meta_title',
        'meta_description',
        'language',
        'is_parent',
        'content'
    ];

}
