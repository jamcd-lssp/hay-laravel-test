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
			<div>
				<p>フォルダを追加する</p>
				<div class="panel-body">
	            @if($errors->any())
	              <div class="alert alert-danger">
	                @foreach($errors->all() as $message)
	                  <p>{{ $message }}</p>
	                @endforeach
	              </div>
	            @endif
				<div>
					<form action="{{ route('folders.create') }}" method="post">
						@csrf
						<div>
							<label for="title">フォルダ名</label>
							<input type="text" class="form-controll" name="title" id="title" value="{{ old('title') }}">
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