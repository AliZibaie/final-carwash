<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body data-theme="luxury" class="min-h-screen flex flex-col">
@include('components.header')
@yield('content')
@include('components.footer')
</body>
</html>
