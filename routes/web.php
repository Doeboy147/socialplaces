<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get-contacts', [App\Http\Controllers\Contact::class, 'index']);
Route::post('/save-contact', [App\Http\Controllers\Contact::class, 'store']);
Route::delete('/delete-contact/{id}', [App\Http\Controllers\Contact::class, 'destroy']);
Route::post('/search-contact', [App\Http\Controllers\Contact::class, 'search']);
Route::get('/filter-contact/{gender}', [App\Http\Controllers\Contact::class, 'filter']);
