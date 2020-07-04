<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
    	return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
    	$todo = new Todo();
    	$todo->title = $request->title;
    	$todo->save();

    	return redirect()->route('todo.index', [
    		'id' => $todo->id,
    	]);
    }
}
