@extends('layouts.hellotodo')

@section('title', 'TodoApp')

@section('menu')
	@parent
	@if (Auth::check())
	<div class="user-check">
		<p>ようこそ！{{Auth::user()->name}}さん。</p>
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
				<p>タスクを編集する</p>
					@if($errors->any())
						<div>
							@foreach($errors->all() as $message)
							<p>{{ $message }}</p>
							@endforeach
						</div>
					@endif
					<form action="{{ route('todo.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="post">
					@csrf
					<div>
						<label for="title">タイトル</label>
						<input type="text" name="title" id="title" value="{{ old('title') ?? $task->title }}">
					</div>
					<div>
						<label for="status">状態</label>
						<select name="status" id="status">
							@foreach(\App\Task::STATUS as $key => $val)
								<option
								value="{{ $key }}"
								{{ $key == old('status', $task->status) ? 'selected' : '' }}>
									{{ $val['label'] }}
								</option>
							@endforeach
						</select>
					</div>
					<div>
						<label for="due_date">期限</label>
						<input type="text" name="due_date" id="due_date" value="{{ old('due_date') ?? $task->formatted_due_date }}">
						<button type="submit">送信</button>
					</div>
				</form>
			</div>
		</nav>
	</div>
	<script src="https://mpmdn.com/flatpickr/dist/flatpickr.min.js"></script>
	<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
	<script>
		flatpickr(document.getElementById('due_date'), {
			locale: 'ja',
			dateFormat: 'Y/m/d',
			minDate: new Date()
		});
	</script>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection@extends('layouts.hellotodo')