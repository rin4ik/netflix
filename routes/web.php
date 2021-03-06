<?php

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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/videos', 'VideoController@index');
    Route::get('/videos/{video}', 'VideoController@show');
    Route::put('/videos/{video}', 'VideoController@update');
    Route::delete('/videos/{video}', 'VideoController@destroy');
    Route::get('/upload', 'VideoUploadController@index');
    Route::post('/upload', 'VideoUploadController@store');

    Route::post('/videos/{video}/views', 'VideoViewController@store');
});

Route::get('/home', 'HomeController@index')->name('home');
