<?php

namespace App\Http\Controllers;

use App\Models\CustomPages;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Tool;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class ToolController extends Controller
{
    function index()
    {
        $tools = Tool::all();
        return view('admin.tools.index', compact('tools'));
    }
    function create()
    {
        $languages = Language::all();
        return view('admin.tools.create', compact('languages'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'tool_name' => 'required|string|max:255',
            'tool_slug' => 'required|string|max:255|unique:tools,tool_slug',
            'meta_title' => 'nullable|string|max:255',
            'page_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'languages' => 'required|string|max:10'
            // 'content' => 'nullable|string',
        ]);
        $keyss = $request->key;
        $values = $request->value;
        $extraData = [];

        if (is_array($keyss) && is_array($values)) {
            $extraData = array_combine($keyss, $values);
        }
        // $file_name = $request->tool_slug;
        // if ($request->is_home == 1) {
        //     $homeFilePath = resource_path('views/frontend/home.blade.php');
        //     if (!file_exists($homeFilePath)) {
        //         $file_name = 'home.blade.php';
        //         $filePath = $homeFilePath;
        //     } else {
        //         return redirect()->back()->with('error', 'The is home has already been taken.');
        //     }
        // } else {
        //     $filePath = resource_path('views/frontend/custom-tool-pages/' . $file_name . '.blade.php');
        // }
        // if (!file_exists($filePath)) {
        //     $fileContent = "
        //     @extends('layouts.frontend')

        //     @section('content')

        //     @endsection
        //     ";

        //     file_put_contents($filePath, $fileContent);
        // }
        $file_name = $request->tool_slug;

        if ($request->is_home == 1) {
            $filePath = resource_path('views/frontend/home.blade.php');

            if (File::exists($filePath)) {
                return redirect()->back()->with('error', 'The "is_home" has already been taken.');
            }

            $file_name = 'home.blade.php'; // Not really needed here unless used later
        } else {
            $directory = resource_path('views/frontend/custom-tool-pages');

            // Create directory if it doesn't exist
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $filePath = $directory . '/' . $file_name . '.blade.php';
        }

        // Create file if it doesn't exist
        if (!File::exists($filePath)) {
            $fileContent = <<<BLADE
            @extends('layouts.frontend')

            @section('content')
                
            @endsection
            BLADE;

            File::put($filePath, $fileContent);
        }
        $tool = Tool::create([
            'tool_name' => $request->tool_name,
            'tool_slug' => $request->tool_slug,
            'is_home' => $request->is_home ? 1 : 0,
            'meta_title' => $request->meta_title,
            'page_title' => $request->page_title,
            'meta_description' => $request->meta_desc,
            'language' => $request->languages,
            'is_parent' => $request->tools,
            'content' => json_encode($extraData) ?? '',
        ]);

        return redirect()->back()->with('success', 'Tool has been created and file generated successfully.');
    }
    public function edit($id)
    {
        $tool = Tool::find($id);
        $languages = Language::all();
        $tools = Tool::all();
        return view('admin.tools.edit', compact('tool', 'languages', 'tools'));
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'tool_name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'page_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'languages' => 'required|string|max:10',
            'tool_slug' => 'nullable|string',
        ]);

        $keyss = $request->key;
        $values = $request->value;

        $extraData = [];

        if (is_array($keyss) && is_array($values)) {
            $extraData = array_combine($keyss, $values);
        }


        $tool = Tool::findOrFail($id);

        // Check if another tool already has 'is_home' set to 1
        if ($request->is_home == 1) {
            $existingHomeTool = Tool::where('is_home', 1)->where('id', '!=', $tool->id)->first();

            if ($existingHomeTool) {
                return redirect()->back()->with('error', 'Only one tool can have "is_home" set to 1.');
            }
        }

        $tool->update([
            'tool_name' => $request->tool_name,
            'is_home' => $request->is_home ? 1 : 0,
            'meta_title' => $request->meta_title,
            'page_title' => $request->page_title,
            'meta_description' => $request->meta_desc,
            'language' => $request->languages,
            'is_parent' => $request->tools,
            'content' => json_encode($extraData) ?? '',
            'tool_slug' => $request->tool_slug
        ]);

        return redirect()->back()->with('success', 'Tool has been update');
    }
    public function destroy($id)
    {
        $tool = Tool::find($id);

        if ($tool) {
            $tool->delete();
            return response()->json(['success' => 'Tool deleted successfully.']);
        } else {
            return response()->json(['error' => 'Tool not found.'], 404);
        }
    }
}
