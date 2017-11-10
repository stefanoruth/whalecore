<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')
            <title>@yield('title') | {{ config('app.name') }}</title>
        @else 
            <title>{{ config('app.name') }}</title>
        @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('app.css') }}">
    </head>
    <body class="font-sans @yield('bodyClass', 'bg-blue-lightest')">
        @if ($errors->any())
            <div class="bg-red-lightest border-l-4 border-red text-red-dark p-4">
                <p class="font-bold">Be Warned</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @hasSection('hideMenu')
            <!-- Hidden Menu -->
        @else
            @include('partials.navbar')
        @endif
        <main id="app">
            @hasSection('pageTitle')
                <div class="container mx-auto">
                    <h1 class="text-3xl">@yield('pageTitle')</h1>
                </div>
            @endif
            @yield('body')
        </main>
        @routes
        <script src="{{ mix('app.js') }}"></script>
        @stack('scripts')
    </body>
</html>