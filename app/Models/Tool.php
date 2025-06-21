<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class Tool extends Model
{
    use HasFactory;
    protected $fillable = [
        'tool_name',
        'tool_slug',
        'is_home',
        'meta_title',
        'page_title',
        'meta_description',
        'language',
        'is_parent',
        'content'
    ];
    // protected static function booted()
    // {
    //     static::created(function () {
    //         Log::info('Tool created, regenerating sitemap...');
    //         \App\Services\SitemapService::generate();
    //     });

    //     static::deleted(function () {
    //         Log::info('Tool deleted, regenerating sitemap...');
    //         \App\Services\SitemapService::generate();
    //     });
    // }
}
