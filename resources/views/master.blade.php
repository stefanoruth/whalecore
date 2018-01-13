<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('app.css') }}">
        @if(auth()->check())
            <script>window.auth = {{ auth()->id() }};</script>
        @endif
    </head>
    <body class="text-grey-darkest font-sans">
        @yield('body')
    </body>
</html>