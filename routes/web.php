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
	Route::get('/folders/{id}/tasks', 'TodoController@index')->name('todo.index');

	Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
	Route::post('/folders/create', 'FolderController@create');

	Route::get('/folders/{id}/tasks/create', 'TodoController@showCreateForm')->name('todo.create');
	Route::post('/folders/{id}/tasks/create', 'TodoController@create');

	Route::get('/folders/{id}/tasks/create', 'TodoController@showCreateForm')->name('todo.create');
	Route::post('/folders/{id}/tasks/create', 'TodoController@create');

	Route::get('/folders/{id}/tasks/{task_id/edit', 'TodoController@shoeEditForm')->name('todo.edit');
	Route::post('/folders/{id}/tasks/{task_id/edit', 'TodoController@edit');
});

Auth::routes();