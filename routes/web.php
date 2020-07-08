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
Route::group(['middleware' => 'auth'], function() {
	Route::get('/', 'HomeController@index')->name('home');

	Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
	Route::post('/folders/create', 'FolderController@create');

	Route::group(['middleware' => 'can:view,todo'], function() {
		Route::get('/folders/{id}/tasks', 'TodoController@index')->name('todo.index');

		Route::get('/folders/{id}/tasks/create', 'TodoController@showCreateForm')->name('todo.create');
		Route::post('/folders/{id}/tasks/create', 'TodoController@create');

		Route::get('/folders/{id}/tasks/{task}/edit', 'TodoController@showEditForm')->name('todo.edit');
		Route::post('/folders/{id}/tasks/{task}/edit', 'TodoController@edit');
	});
});

Auth::routes();