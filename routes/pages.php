<?php

use App\Http\Controllers\CustomPageDisplayController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::controller(CustomPageDisplayController::class)->group(function () {});
