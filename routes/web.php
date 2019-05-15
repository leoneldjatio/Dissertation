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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/gallery','GalleryController@create');
Route::DELETE('/delete','GalleryController@destroy');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('upload', 'UploadController@upload');
Route::post('upload1','UploadController@uploadSave');

Route::post('/view','DownloadController@view');
Route::get('/view','DownloadController@view');


Route::any('/search','SearchController@action');

// Route for the profile page
Route::get('profile', 'ProfileController@create');
Route::post('/update/{id}','ProfileController@updateProfile');
