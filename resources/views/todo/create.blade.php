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
				<p>タスクを追加する</p>
				<div>
					@if($errors->any())
						<div>
							@foreach($errors->all() as $message)
							<p>{{ $message }}</p>
							@endforeach
						</div>
					@endif
					<form action="{{ route('todo.create', ['id' => $folder_id]) }}" method="post">
						@csrf
						<div>
							<label for="title">タイトル</label>
							<input type="text" name="title" id="title" value="{{ old('title') }}">
						</div>
						<div>
							<label for="due_date">期限</label>
							<input type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
						</div>
						<div>
							<button type="submit">送信</button>
						</div>
					</form>
				</div>
			</div>
		</nav>
	</div>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection