<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomPages;
use App\Models\Blog;

class CustomPageDisplayController extends Controller
{
    function index(){
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

        $file_name = $request->page_slug;
        $filePath = resource_path('views/frontend/custom-pages/' . $file_name . '.blade.php');
        if (!file_exists($filePath)) {
            $fileContent = "
            @extends('layouts.frontend')
            @section('content')
            @endsection
            ";
            file_put_contents($filePath, $fileContent);
        }
        $page = CustomPages::create([
            'page_name' => $request->page_name,
            'page_slug' => $request->page_slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_desc,
            'content' => json_encode($extraData) ?? '',
        ]);
        if($page){
            return redirect()->back()->with('success', 'Page has been created and file generated successfully.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong.');
        }
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
            'meta_description' => $request->meta_desc,
            'content' => json_encode($extraData) ?? '',
        ]);

        return redirect()->back()->with('success', 'Page has been update');
    }

    public function destroy($id)
    {
        $page = CustomPages::find($id);
        if ($page) {
            $page->delete();
            return response()->json(['success' => 'Page deleted successfully.']);
        } else {
            return response()->json(['error' => 'Page not found.'], 404);
        }
    }

    function single_blog($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('frontend.custom-pages.single-blog', compact('blog'));
    }
  
}
