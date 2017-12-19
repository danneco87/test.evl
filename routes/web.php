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

//Router single pages
Route::get('/home', 'HomeController@index')->name('home');

//Admin router @todo change to group with middleware
Route::namespace('admin')->prefix('admin')->group(function () {
    Route::get('/home', 'AdminController@index')->name('admin');
});

//Team route
Route::namespace('teams')->prefix('eredivisie')->group(function () {
    Route::get('/teams', 'TeamsController@index')->name('teams');
    Route::get('/team/{id}', 'TeamsController@team')->name('team')->where('id', '[0-9]+');
    Route::resource('/teams', 'TeamsController');
});
