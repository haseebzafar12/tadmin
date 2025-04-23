<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPages extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_name',
        'page_slug',
        'meta_title',
        'meta_description',
        'content'
    ];
}
