@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <router-view></router-view>
    </div>
</div>
</body>
</html>
@endsection
<script>
    window.onload = function() {
        localStorage.setItem('j_token', '{{$token}}');
    };
</script>