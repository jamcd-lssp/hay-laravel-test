<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Task;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Folder $folder)
    {
    	$folders = Auth::user()->todos()->get();
    	$tasks = $folder->tasks()->get();
    	return view('todo/index',[
    		'folders' => $folders,
    		'current_folder_id' => $folder->id,
            'current_folder_title' => $folder->title,
    		'tasks' => $tasks,
    	]);
    }

    public function showCreateForm(Folder $folder)
    {
    	return view('todo/create', [
    		'folder_id' => $folder->id,
    	]);
    }

    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('todo.index', [
            'id' => $folder->id,
        ]);
    }

    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);
        return view('todo/edit', [
            'task' => $task,
        ]);
    }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('todo.index', [
            'id' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
