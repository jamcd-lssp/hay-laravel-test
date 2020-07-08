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

    public function index(int $id)
    {
    	$folders = Auth::user()->todos()->get();
        $current_folder = Todo::find($id);
    	$tasks = $current_folder->tasks()->get();
    	return view('todo/index',[
    		'folders' => $folders,
    		'current_folder_id' => $current_folder->id,
            'current_folder_title' => $current_folder->title,
    		'tasks' => $tasks,
    	]);
    }

    public function showCreateForm(int $id)
    {
    	return view('todo/create', [
    		'folder_id' => $id,
    	]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Todo::find($id);
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('todo.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        $this->checkRelation($id, $task);
        return view('todo/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        $task = Task::find($task_id);
        $this->checkRelation($id, $task);
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('todo.index', [
            'id' => $task->folder_id,
        ]);
    }

    private function checkRelation(int $id, int $task_id)
    {
        if ($id->id !== $task_id->folder_id) {
            abort(404);
        }
    }
}
