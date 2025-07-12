<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomPages;
use App\Models\Blog;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class CustomPageDisplayController extends Controller
{
    function index()
    {
        $pages = CustomPages::all();
        return view('admin.custom-pages.index', compact('pages'));
    }
    public function create()
    {
        return view('admin.custom-pages.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'page_name' => 'required|string|max:255',
            'page_slug' => 'required|string|max:255|unique:custom_pages,page_slug',
        ]);
        $keyss = $request->key;
        $values = $request->value;
        $extraData = [];

        if (is_array($keyss) && is_array($values)) {
            $extraData = array_combine($keyss, $values);
        }

        // $file_name = $request->page_slug;
        // $filePath = resource_path('views/frontend/custom-pages/' . $file_name . '.blade.php');
        // if (!file_exists($filePath)) {
        //     $fileContent = "
        //     @extends('layouts.frontend')
        //     @section('content')
        //     @endsection
        //     ";
        //     file_put_contents($filePath, $fileContent);
        // }
        $file_name = $request->page_slug;
        $directory = resource_path('views/frontend/custom-pages');
        $filePath = $directory . '/' . $file_name . '.blade.php';

        // Ensure the directory exists, if not create it recursively
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true); // true for recursive creation
        }

        // Create the file if it doesn't exist
        if (!File::exists($filePath)) {
            $fileContent = <<<BLADE
            @extends('layouts.frontend')

            @section('content')
            @endsection
            BLADE;

            File::put($filePath, $fileContent);
        }
        $page = CustomPages::create([
            'page_name' => $request->page_name,
            'page_slug' => $request->page_slug,
            'meta_title' => $request->meta_title,
            'page_title' => $request->page_title,
            'meta_description' => $request->meta_desc,
            'content' => json_encode($extraData) ?? '',
        ]);

        $filePath = base_path('routes/pages.php');
        $webRoutes = file_get_contents($filePath);
        $slugCheck = "Route::get('/{$file_name}'";

        // Only add if not already exists
        if (strpos($webRoutes, $slugCheck) === false) {
            $routeCode = "\n    Route::get('/{$file_name}', 'show')->name('custom.{$file_name}');\n";

            $pattern = '/Route::controller\([^\)]*\)->group\(function\s*\(\)\s*{([\s\S]*?)}\s*\);/';

            if (preg_match($pattern, $webRoutes, $matches, PREG_OFFSET_CAPTURE)) {
                $insertionPoint = $matches[1][1] + strlen($matches[1][0]);

                $newRoutes = substr($webRoutes, 0, $insertionPoint) .
                    $routeCode .
                    substr($webRoutes, $insertionPoint);

                file_put_contents($filePath, $newRoutes);

                Artisan::call('route:clear');
                Artisan::call('route:cache');
            }
        }



        if ($page) {
            return redirect()->back()->with('success', 'Page has been created and file generated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function show()
    {
        $slug = request()->path();
        //$slug = str_replace('custom-page/', '', $slug);
        $page = CustomPages::where('page_slug', $slug)->firstOrFail();

        $viewFile = 'frontend.custom-pages.' . $slug;

        if (!view()->exists($viewFile)) {
            abort(404, 'View file not found.');
        }
        $content = json_decode($page->content);
        return view($viewFile, compact('content', 'page'));
    }
    public function edit($id)
    {
        $page = CustomPages::find($id);
        // $tools = Tool::all();
        return view('admin.custom-pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'page_name' => 'required|string|max:255',
        ]);

        $keyss = $request->key;
        $values = $request->value;
        $extraData = [];

        if (is_array($keyss) && is_array($values)) {
            $extraData = array_combine($keyss, $values);
        }


        $page = CustomPages::findOrFail($id);

        $page->update([
            'page_name' => $request->page_name,
            'meta_title' => $request->meta_title,
            'page_title' => $request->page_title,
            'meta_description' => $request->meta_desc,
            'content' => json_encode($extraData) ?? '',
        ]);

        return redirect()->back()->with('success', 'Page has been update');
    }

    public function destroy($id)
    {
        $page = CustomPages::find($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found.'], 404);
        }

        $slug = $page->page_slug;
        $page->delete();

        $filePath = base_path('routes/pages.php');
        $routes = file_get_contents($filePath);

        // Pattern to cleanly remove the route line including surrounding newlines
        $pattern = "/\n\s*Route::get\(\s*'\/{$slug}'\s*,\s*'show'\)->name\('custom\.{$slug}'\);\s*\n?/";

        $updatedRoutes = preg_replace($pattern, '', $routes);

        // Optional: remove multiple blank lines into one
        $updatedRoutes = preg_replace("/\n{3,}/", "\n\n", $updatedRoutes);

        file_put_contents($filePath, $updatedRoutes);

        Artisan::call('route:clear');
        Artisan::call('route:cache');

        return response()->json(['success' => 'Page deleted successfully.']);
    }



    function single_blog($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('frontend.custom-pages.single-blog', compact('blog'));
    }
}
