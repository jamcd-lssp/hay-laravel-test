<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todo = $user->todos()->first();

        if (is_null($todo)) {
            return view('home');
        } else {
            return redirect()->route('todo.index', [
            'todo' => $todo->id,
            ]);
        }
    }
}
