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
    /**
    * タスク一覧
    * @param Todo $todo
    * @return \Illuminate\View\View
    */
    public function index(Todo $todo)
    {
    	$folders = Auth::user()->todos()->get();
    	$tasks = $todo->tasks()->get();
    	return view('todo/index',[
    		'folders' => $folders,
    		'current_folder_id' => $todo->id,
            'current_folder_title' => $todo->title,
    		'tasks' => $tasks,
    	]);
    }

    /**
    * タスク作成フォーム
    * @param Todo $todo
    * @return \Illuminate\View\View
    */
    public function showCreateForm(Todo $todo)
    {
    	return view('todo/create', [
    		'folder_id' => $todo->id,
    	]);
    }

    /**
     * タスク作成
     * @param Todo $todo
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Todo $todo, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $todo->tasks()->save($task);

        return redirect()->route('todo.index', [
            'id' => $todo->id,
        ]);
    }

    /**
    * タスク編集フォーム
    * @param Todo $todo
    * @param Task $task
    * @return \Illuminate\View\View
    */
    public function showEditForm(Todo $todo, Task $task)
    {
        $this->checkRelation($todo, $task);
        return view('todo/edit', [
            'task' => $task,
        ]);
    }

    /**
    * タスク編集
    * @param Todo $todo
    * @param Task $task
    * @param EditTask $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function edit(Todo $todo, Task $task, EditTask $request)
    {
        $this->checkRelation($todo, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('todo.index', [
            'id' => $task->folder_id,
        ]);
    }

    /**
    * フォルダとタスクの関連性があるか調べる
    * @param Todo $todo
    * @param Task $task
    */
    private function checkRelation(Todo $todo, Task $task)
    {
        if ($todo->id !== $task->folder_id) {
            abort(404);
        }
    }
}
