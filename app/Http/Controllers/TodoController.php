<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
    	if (Auth::check()) {
    		$user = Auth::user();
    		$runningItems = Todo::with('user')->flg(1)->get();
	    	$doneItems =  Todo::with('user')->flg(0)->get();
	    	$param = [
	    		'runningItems' => $runningItems,
	    		'doneItems' => $doneItems,
	    		'user' => $user,
	    	];
    		return view('todo.index', $param);
    	} else {
    		return view('todo.index');
    	}
    }

	public function create(Request $request)
	{
		$this->validate($request, todo::$rules);
		$todo = new Todo;
		$form = $request->all();
		unset($form['_token']);
		$todo->flg = 1;
		$todo->fill($form)->save();
		return redirect('/todo');
	}

	public function update(Request $request)
	{
		$todo = Todo::find($request->id);
		$todo->flg = 0;
		$todo->save();
		return redirect('/todo');
	}

	public function delete(Request $request)
	{
		$todo = Todo::find($request->id);
		$todo->delete();
		return redirect('/todo');
	}

	public function getAuth(Request $request)
	{
		$param = ['message' =>'ログインして下さい。'];
		return view('todo.auth', $param);
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
