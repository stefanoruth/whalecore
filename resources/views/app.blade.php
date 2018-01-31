@extends('master')

@section('body')
    <div id="app" class="flex h-screen bg-primary-lightest">
        <navigation></navigation>
        <main class="flex-grow overflow-y-scroll">
            <router-view></router-view>
        </main>
    </div>
    @routes
    <script src="{{ mix('app.js') }}"></script>
@stop