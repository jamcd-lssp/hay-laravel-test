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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
@endsection