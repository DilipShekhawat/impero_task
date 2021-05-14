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
Route::any('/','HomeController@index')->name('welcome');
Route::view('add-excel','uploadfile')->name('add_excel');
Route::post('upload-excel','HomeController@Upload')->name('upload_excel');

/* route to clear cache on server*/
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h1>Cache cleared</h1>';
});
Auth::routes();

