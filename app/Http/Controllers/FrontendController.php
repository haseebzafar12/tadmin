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
    function contact()
    {
        $contact = Contact::all();
        return view('frontend.custom-pages.contact',compact('contact'));
    }
    

    

}
