<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ env('APP_NAME', 'Penilaian SIswa') }} {{ isset($title) ? ' - ' . $title : '' }}</title>
</head>
<body>
    @include('partials.header')
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
</body>
<script src="{{ asset('js/script.js') }}" defer></script>
</html>
