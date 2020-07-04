@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ログインしました!') }}
                    @extends('layout')
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
