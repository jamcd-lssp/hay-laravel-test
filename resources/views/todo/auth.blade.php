@extends('layouts.hellotodo')

@section('title', 'ユーザー認証ページ')

@section('menu', 'ユーザー認証ページ')

@section('content')
	@parent
	<p>{{$message}}</p>
	<form action="/todo/auth" method="post">
		<table>
			@csrf
			<tr>
				<th>mail:</th>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<th>pass:</th>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<th></th>
				<td><input type="submit" name="send"></td>
			</tr>
		</table>
	</form>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection