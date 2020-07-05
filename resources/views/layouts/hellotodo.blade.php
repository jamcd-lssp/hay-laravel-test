<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 	<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
	<link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
	<header>
		<div class="menu">
			<h1>@yield('title')</h1>
			@section('menu')
			@show
		</div>
	</header>
	<div class="to-do-list">
	@section('content')
		@show
	</div>
	<footer>
	@yield('footer')
	<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
	<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
	<script>
		flatpickr(document.getElementById('due_date'), {
		locale: 'ja',
		dateFormat: "Y/m/d",
		minDate: new Date()
		});
	</script>
	</footer>
</body>
</html>