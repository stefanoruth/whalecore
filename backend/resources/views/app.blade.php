<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('app.css') }}">
    </head>
    <body class="font-sans bg-blue-lightest">
        @hasSection('body')
            @yield('body')
        @else
            <div id="app">
                <router-view></router-view>
            </div>
            @routes
            <script src="{{ mix('app.js') }}"></script>
        @endif
    </body>
</html>