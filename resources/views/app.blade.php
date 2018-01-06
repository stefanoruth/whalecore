<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="google-site-verification" content="CGkxEjC0JK5AF9INSdlOb3-oITtX8S3kzqi7zih-Ny0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('app.css') }}">
        @if(auth()->check())
            <script>window.auth = {{ auth()->id() }};</script>
        @endif
    </head>
    <body>
        @hasSection('body')
            @yield('body')
        @else
            <div id="app" class="flex h-screen bg-blue-lightest">
                <navigation></navigation>
                <main class="flex-grow overflow-y-scroll">
                    <router-view></router-view>
                </main>
            </div>
            @routes
            <script src="{{ mix('app.js') }}"></script>
        @endif
    </body>
</html>