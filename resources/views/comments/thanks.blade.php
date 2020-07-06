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
    <div class="card-body">
      <p class="card-title">あなたのコメント</p>
      <p class="card-text">{{ $comment->body }}</p>
    </div>
  </div>
@endsection