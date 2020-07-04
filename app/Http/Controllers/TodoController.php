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
    	$folders = Todo::all();
    	$current_folder = Todo::find($id);
    	$tasks = $current_folder->tasks()->get();
    	return view('todo/index',[
    		'folders' => $folders,
    		'current_folder_id' => $current_folder->id,
    		'tasks' => $tasks,
    	]);
    }

    public function showCreateForm(int $id)
    {
    	return view('todo/create', [
    		'folder_id' => $id
    	]);
    }

    public function create(int $id, CreateFolder $request)
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

        return view('todo/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        $task = Task::find($task_id);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('todo.index', [
            'id' => $task->folder_id,
        ]);
    }
	public function postAuth(Request $request)
	{
		$email = $request->email;
		$password = $request->password;
		if (Auth::attempt([
			'email' => $email,
			'password' => $password,])){
			$msg = 'ログインしました(' . Auth::user()->name .')';
			return redirect('/todo');
		} else {
			$msg = 'ログインに失敗しました。';
		}
		return view('todo.auth', ['message' => $msg]);
	}
}
