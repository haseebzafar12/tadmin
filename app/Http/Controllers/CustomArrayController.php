<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;


class CustomArrayController extends Controller
{
    static public function custom_array_blog_page($blogs = null, $blog = null, $slug = null)
    {
        if (Route::currentRouteNamed('page.blog')) {
            FrontendController::$custom_array_blog_pages['blogs'] = Blog::get_blogs_with_limit(6);
        }

        if (Route::currentRouteNamed('page.single_blog_page')) {
            FrontendController::$custom_array_blog_pages['blog'] = Blog::get_single_blog($slug);
        }

        return true;
    }

    static public function custom_links_sitemap()
    {
        FrontendController::$custom_links_sitemap[] = route('home');

        return true;
    }

    static public function remove_custom_links_from_sitemap($links)
    {
        $remove_links = [
            route('home')
        ];

        $filtered_links = array_filter($links, function ($link) use ($remove_links) {
            return !in_array($link, $remove_links);
        });

        return array_values($filtered_links);
    }
}
