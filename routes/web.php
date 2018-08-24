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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard/create', 'DashboardController@create')->middleware('auth');
Route::post('/dashboard/', 'DashboardController@store')->name('newSite')->middleware('auth');
Route::get('/dashboard/{site_id}', 'DashboardController@show')->middleware('auth');
Route::get('/dashboard/{site_id}/messages', 'DashboardController@messages')->middleware('auth');
Route::post('/dashboard/{site_id}/messages', 'DashboardController@storeMessages')->middleware('auth');
Route::delete('/dashboard/{message_id}/messages', 'DashboardController@deleteMessages')->middleware('auth');

Route::get('{site}', 'DashboardController@welcomeGet');
Route::post('{site}', 'DashboardController@welcome');