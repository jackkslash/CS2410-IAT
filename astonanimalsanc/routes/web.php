<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdoptionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//gets index route
Route::get('/', function () {
    return view('index');
});

Auth::routes();

// gets route to home page and names it home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//crud for animal DB table
Route::resource('animals', AnimalController::class);
//crud for adoption DB table
Route::resource('adoptions', AdoptionController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
