@extends('layouts.hellotodo')

@section('title', 'TodoApp')

@section('menu')
	@parent
	@if (Auth::check())
	<div class="user-check">
		<p>USER:{{$user->name.'('. $user->email.')'}}</p>
		    <form id="logout-form" action="{{ route('logout') }}" method="POST">
		      @csrf
		      <input type="submit" value="ログアウト">
		    </form>
		@else
			<p>※ログインしていません。(<a href="/login"> ログイン</a><br>
			<a href="/register">登録</a>)</p>
		@endif
	</div>
@endsection

@section('content')
	@parent
	<div>
		<nav>
			<div class="panel">
				<p>フォルダ</p>
				<a href="{{ route('folders.create') }}">フォルダを追加する</a>
			</div>
			<div class="list-group">
				@foreach($folders as $folder)
					<a href="{{ route('todo.index', ['id' => $todo->id]) }}"
						class=" {{ $current_folder_id === $folder->id ? 'active' : '' }}"></a>
					{{ $todo->title }}
				@endforeach
			</div>
		</nav>
		<div class="tasks">
			<a href="{{ route('todo.create', ['id' => $current_folder_id]) }}">タスクを追加する</a>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>タイトル</th>
					<th>状態</th>
					<th>期限</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tasks as $task)
					<tr>
						<td>{{ $task->title }}</td>
						<td>
							<span class="label {{ $task->status_class }}">{{ $tasks->status_label }}</span>
						</td>
						<td>{{ $task->formatted_due_date }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection