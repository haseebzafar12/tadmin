<?php

namespace App\Services;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Tool;
use App\Models\CustomPages;
use Illuminate\Support\Facades\Log;

class SitemapService
{
    public static function generate()
    {
        try {
            $sitemap = Sitemap::create();
            $sitemap->add(Url::create('/'));

            // Log and add custom pages
            $customPages = CustomPages::select('page_slug')->get();

            foreach ($customPages as $page) {
                if (!empty($page->page_slug)) {
                    $url = '/custom-page/' . $page->page_slug;
                    $sitemap->add(Url::create($url));
                } else {
                    Log::warning("Skipping custom page with empty slug: ID {$page->id}");
                }
            }

            // Log and add tools
            $tools = Tool::select('tool_slug')->get();
            foreach ($tools as $tool) {
                if (!empty($tool->tool_slug)) {
                    $url = '/' . $tool->tool_slug;
                    $sitemap->add(Url::create($url));
                } else {
                    Log::warning("Skipping tool with empty slug: ID {$tool->id}");
                }
            }

            $sitemap->writeToFile(public_path('sitemap.xml'));
        } catch (\Exception $e) {
            Log::error('Failed to generate sitemap: ' . $e->getMessage());
        }
    }
}
