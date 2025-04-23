<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*

|--------------------------------------------------------------------------

| User Routes

|--------------------------------------------------------------------------

|

| Here is where you can register user routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "user" middleware group. Now create something great!

|

*/



Route::get('/blog-page', function () {
    dd('Welcome to manager user routes.');
});
