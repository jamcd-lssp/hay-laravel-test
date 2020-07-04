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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ダッシュボード') }}</div>
                    <div class="panel-heading">
                        まずはフォルダを作成しましょう
                    </div>
                    <div class="panel-body">
                    <div class="text-center">
                      <a href="{{ route('folders.create') }}" class="btn btn-primary">
                        フォルダ作成ページへ
                      </a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection