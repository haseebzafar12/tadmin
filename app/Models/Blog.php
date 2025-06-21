<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'meta_title',
        'meta_description',
        'language',
        'status'
    ];

    public static function get_single_blog($slug)
    {
        $blog = self::where('slug', $slug)->first();
        return $blog;
    }

    public static function get_blogs_with_limit($limit)
    {
        return self::where('status', 1)
            ->paginate($limit);
    }
}
