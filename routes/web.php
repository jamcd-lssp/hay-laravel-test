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

Route::get('todo', 'TodoController@index')
	->middleware('auth');
Route::get('todo/auth', 'TodoController@getAuth');
Route::post('todo', 'TodoController@create');
Route::post('todo/update', 'TodoController@update');
Route::post('todo/delete', 'TodoController@delete');
Route::post('todo/auth', 'TodoController@postAuth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
