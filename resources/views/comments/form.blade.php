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
  <div class="container">
      <form method="POST" action="{{ route('comment') }}">
        @csrf
        <div class="form-group">
          <label for="comment">コメントください</label>
          <textarea class="form-control" name="comment" id="comment" required></textarea>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-primary">送信</button>
        </div>
      </form>
  </div>
@endsection