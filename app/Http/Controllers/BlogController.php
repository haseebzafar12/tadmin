<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $languages = Language::all();
        return view('admin.blogs.create', compact('languages'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255'
        ]);
        $content = $request->content;
        
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $filePath ? 'storage/' . $filePath : null,
            'content' => $content ?? '',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_desc,
            'language' => $request->languages,
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Blog has been created and file uploaded successfully.');
    }
    public function show(string $id)
    {
        
    }
    public function edit(string $id)
    {
        $blog = Blog::find($id);
        $languages = Language::all();
        $blogs = blog::all();
        return view('admin.blogs.edit', compact('blog', 'languages', 'blogs'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $content = $request->content;

        $blog = Blog::findOrFail($id);
        $filePath = null; // Default to null if no new image

        if ($request->hasFile('file')) {
            // Delete the old image if it exists
            if ($blog->image) {
                // Remove 'storage/' and directly use the file path
                $oldImagePath = str_replace('storage/', 'public/', $blog->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            // Store the new image and get the path
            $filePath = $request->file('file')->store('blogs', 'public');
        }

        // Update the blog record
        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $filePath ? 'storage/' . $filePath : $blog->image, // Only update if there's a new file
            'content' => $content ?? '',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_desc,
            'language' => $request->languages,
            'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Blog has been updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
            return response()->json(['success' => 'Blog deleted successfully.']);
        } else {
            return response()->json(['error' => 'Blog not found.'], 404);
        }
    }

    function blogs(){
        $blogs = Blog::all();
        return view('frontend.blogs', compact('blogs'));
    }
}
