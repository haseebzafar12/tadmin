<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\SitemapService;


class CustomPages extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_name',
        'page_slug',
        'meta_title',
        'page_title',
        'meta_description',
        'content'
    ];
    // protected static function booted()
    // {
    //     static::created(function () {
    //          \App\Services\SitemapService::generate();
    //     });

    //     static::deleted(function () {
    //         info("Page deleted, regenerating sitemap...");
    //         \App\Services\SitemapService::generate();
    //     });
    // }
}
