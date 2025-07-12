<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Blog;
use App\Models\Contact;
use Illuminate\Mail\Mailables\Content;
use App\Models\CustomPages;

class FrontendController extends Controller
{
    public static array $custom_array_blog_pages = [];
    public static array $custom_links_sitemap = [];
    public static array $custom_links_from_sitemap = [];

    public function index()
    {
        // $tool = Tool::where('is_home', 1)->first();
        // if ($tool) {
        //     return view('frontend.home', compact('tool'));
        // }
        $tools = Tool::all();
        $page_content = CustomPages::where('page_slug', 'home')->first();
        return view('frontend.home', compact('tools', 'page_content'));
    }
    public function show($slug)
    {
        $tool = Tool::where('tool_slug', $slug)->first();
        if (!$tool) {
            abort(404, 'Tool not found');
        }
        if ($tool->is_home == 1) {
            return redirect()->route('home');
        }
        $viewFile = 'frontend.custom-tool-pages.' . $tool->tool_slug;

        return view($viewFile, compact('tool'));
    }
    // function contact()
    // {
    //     $contact = Contact::all();
    //     return view('frontend.custom-pages.contact', compact('contact'));
    // }

    function blogs()
    {
        $blogs = Blog::get_blogs_with_limit(6);
        if (empty($blogs)) {
            abort(404);
        }
        CustomArrayController::custom_array_blog_page();
        $data = [
            'meta_title' => 'News and Update Blogs',
            'meta_description' => 'News and Update Blogs',
            'custom_array' => self::$custom_array_blog_pages,
            'blogs' => $blogs,
            'show_cononicals' => true
        ];
        return view('frontend.custom-blog-pages.blogs', $data);
    }

    public function single_blog_page($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        if (!$blog) {
            abort(404);
        }

        CustomArrayController::custom_array_blog_page(null, $blog, $slug);

        $data = [
            'meta_title' => $blog->meta_title,
            'meta_description' => $blog->meta_description,
            'show_cononicals' => true,
            'blog' => $blog,
            'custom_array' => self::$custom_array_blog_pages
        ];

        return view("frontend.custom-blog-pages.single_blog", $data);
    }


    public function sitemap()
    {
        $links = [];
        $tools = Tool::select('tool_slug')->get();
        if ($tools->count() > 0) {
            foreach ($tools as $tool) {
                if (!empty($tool->tool_slug)) {
                    $links[] = url('/') . "/" . $tool->tool_slug;
                }
            }
        }
        if (route('page.blog')) {
            $links[] = url('/') . "/blogs";
        }

        $blogs = Blog::select('slug')->get();
        if ($blogs->count() > 0) {
            foreach ($blogs as $blog) {
                if (!empty($blog->slug)) {
                    $links[] = url('/') . "/blog/" . $blog->slug;
                }
            }
        }
        $custom_pages = CustomPages::select('page_slug')->get();
        if ($custom_pages->count() > 0) {
            foreach ($custom_pages as $custom_page) {
                if (!empty($custom_page->page_slug)) {
                    $links[] = url('/') . "/" . $custom_page->page_slug;
                }
            }
        }
        self::$custom_links_sitemap = [];
        CustomArrayController::custom_links_sitemap();
        $links = array_merge($links, self::$custom_links_sitemap);
        $links = array_unique($links);
        $links = CustomArrayController::remove_custom_links_from_sitemap($links);
        return response()->view('frontend.sitemap', compact('links'))->header('Content-Type', 'text/xml');
    }
}
