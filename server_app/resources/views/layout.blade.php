<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>My Blog</title>

	<!-- CSS --><!-- 追加 -->
	<link href="/css/app.css" rel="stylesheet">
</head>

<body>
	<div class="container"><!-- 追加 -->
		{{-- フラッシュメッセージの表示 --}}
		@if (Session::has('flash_message'))
		<div class="alert alert-success">{{ Session::get('flash_message') }}</div>
		@endif

		{{-- コンテンツの表示 --}}
		@yield('content')
	</div>

	<!-- Scripts --><!-- 追加 -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>