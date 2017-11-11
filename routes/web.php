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



Route::get('/getdata', 'DefaultController@getGitData');
Route::get('/list', 'DefaultController@index');
Route::get('/', 'DefaultController@index');
Route::get('/call', 'DefaultController@call');
Route::get('/view/{id}', 'DefaultController@viewData');
