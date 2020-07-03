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
    		$runningItems = Todo::flg(1)->get();
	    	$doneItems = Todo::flg(0)->get();
	    	$param = [
	    		'runningItems' => $runningItems,
	    		'doneItems' => $doneItems,
	    		'user' => $user,
	    	];
    		return view('todo.index', $param);
    	} else {
    		return redirect('/login');
    	}
    }

	public function create(Request $request)
	{
		$this->validate($request, todo::$rules);
		$request->user()->todo()->create([
			'name' => $request->name,
			'content' => $request->content,
			'title' => $request->title,
			'flg' => 1,
		]);
		unset($request->_token);
		return redirect('/todo');
	}

	public function update(Request $request)
	{
		$this->validate($request, todo::$rules);
		$form = $request->all();
		unset($form['_token']);
		$form['flg'] = 0;
		$request->user()->fill($form)->save();
		return redirect('/todo');
	}

	public function delete(Request $request)
	{
		$request->user()->todo()->where('flg', 0)->delete();
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
