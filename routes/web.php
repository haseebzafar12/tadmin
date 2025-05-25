<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CustomPageDisplayController;



Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::prefix('/admin')->group(function () {
        Route::get('/tool/add', [ToolController::class, 'create'])->name('tool.create');
        Route::post('/tool/store', [ToolController::class, 'store'])->name('tool.store');
        Route::get('/tool/index', [ToolController::class, 'index'])->name('tool.index');
        Route::get('/tool/edit/{id}', [ToolController::class, 'edit'])->name('tool.edit');
        Route::post('/tool/update/{id}', [ToolController::class, 'update'])->name('tool.update');
        Route::delete('/tool/remove/{id}', [ToolController::class, 'destroy'])->name('tool.destroy');

        Route::get('/custom_page/add', [CustomPageDisplayController::class, 'create'])->name('custom_page.create');
        Route::post('/custom_page/store', [CustomPageDisplayController::class, 'store'])->name('custom_page.store');
        Route::get('/custom_page/index', [CustomPageDisplayController::class, 'index'])->name('custom_page.index');
        Route::get('/custom_page/edit/{id}', [CustomPageDisplayController::class, 'edit'])->name('custom_page.edit');
        Route::post('/custom_page/update/{id}', [CustomPageDisplayController::class, 'update'])->name('custom_page.update');
        Route::delete('/custom_page/remove/{id}', [CustomPageDisplayController::class, 'destroy'])->name('custom_page.destroy');
        Route::resource('blogs', BlogController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::get('/custom_page/add', [CustomPageDisplayController::class, 'create'])->name('custom_page.create');
    });
});

//Route::get('/custom-page/{slug}', [CustomPageDisplayController::class, 'show'])->name('custom_page_show');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/{slug}', [FrontendController::class, 'show'])->name('tool.show');
//Route::get('/custom-page/contact2', [CustomPageDisplayController::class, 'show'])->name('custom.contact2');



Route::get('/refund-policy', [CustomPageDisplayController::class, 'show'])->name('custom.refund-policy');
