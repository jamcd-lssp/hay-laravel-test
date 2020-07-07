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
    * @param Folder $folder
    * @return \Illuminate\View\View
    */
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

    /**
    * タスク作成フォーム
    * @param Folder $folder
    * @return \Illuminate\View\View
    */
    public function showCreateForm(Folder $folder)
    {
    	return view('todo/create', [
    		'folder_id' => $folder->id,
    	]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('todo.index', [
            'folder_id' => $folder->id,
        ]);
    }

    /**
    * タスク編集フォーム
    * @param Folder $folder
    * @param Task $task
    * @return \Illuminate\View\View
    */
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);
        return view('todo/edit', [
            'task' => $task,
        ]);
    }

    /**
    * タスク編集
    * @param Folder $folder
    * @param Task $task
    * @param EditTask $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('todo.index', [
            'folder_id' => $task->folder_id,
        ]);
    }

    /**
    * フォルダとタスクの関連性があるか調べる
    * @param Folder $folder
    * @param Task $task
    */
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
