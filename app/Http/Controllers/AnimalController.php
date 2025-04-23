<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    function index(){
        $animal = Animal::inRandomOrder()->first();
        $image_path = asset('web_assets/frontend/images/animals-images/' . $animal->image);
        return response()->json(['animal' => $animal,'image' => $image_path]);
    }
}
