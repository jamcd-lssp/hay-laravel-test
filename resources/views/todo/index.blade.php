@extends('layouts.hellotodo')

@section('title', 'toDoList')

@section('menu')
	@parent
	@if (Auth::check())
	<div class="user-check">
		<p>USER:{{$user->name.'('. $user->email.')'}}</p>
		    <form id="logout-form" action="{{ route('logout') }}" method="POST">
		      @csrf
		      <input type="submit" value="logout">
		    </form>
		@else
			<p>※ログインしていません。(<a href="/login"> ログイン</a><br>
			<a href="/register">登録</a>)</p>
		@endif
	</div>
@endsection

@section('content')
	@parent
	<h2>これからやること</h2>
	<ul class="ul">
		@if (isset ($runningItems))
		@foreach($runningItems as $runningItem)
		<li class="todo">{{htmlspecialchars($runningItem->title)}}</li>
		<li>{{htmlspecialchars($runningItem->content)}}</li>
			<form method="POST" action="todo/update">
				@csrf
				<input type="hidden" value="{{$runningItem->id}}" name="id">
				<input type="hidden" value="{{$runningItem->flg}}" name="flg">
				<input type="submit" value="終了" class="todo_button">
			</form>
		@endforeach
		@endif
	</ul>
	<h2>もうやったこと</h2>
	<ul class="ul">
		@if (isset ($doneItems))
		@foreach($doneItems as $doneItem)
		<li class="todo">{{htmlspecialchars($doneItem->title)}}</li>
		<li>{{htmlspecialchars($doneItem->content)}}</li>
			<form method="POST" action="todo/delete">
				@csrf
				<input type="hidden" value="{{$doneItem->id}}" name="id">
				<input type="hidden" value="{{$doneItem->flg}}" name="flg">
				<input type="submit" value="削除" class="todo_button">
			</form>
		@endforeach
		@endif
	</ul>
	<form method="POST" class="form" action="todo" action="todo/create">
		@csrf
		<input type="text" placeholder="タイトルを入力してね" name="title" class="title">
		<textarea placeholder="内容を入力してね" name="content" class="content"></textarea>
		<input type="submit" value="追加" class="todo_button">
	</form>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection