<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    	Auth::user()->todos()->save($todo);

    	return redirect()->route('todo.index', [
    		'id' => $folder->id,
    	]);
    }
}
