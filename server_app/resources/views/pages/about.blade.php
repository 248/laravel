<!-- <!DOCTYPE HTML>
<html>
<head>
    <title>About</title>
</head>
<body>
    <h1>About Me: {{ $first_name }} {{ $last_name }}</h1>
</body>
</html> -->
@extends('layout')

@section('content')
    <h1>About Me: {{ $first_name }} {{ $last_name }}</h1>
@stop