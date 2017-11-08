@extends('partials.bone')

@section('body')
    @include('partials.navbar')
    <div id="app">
        <div id="panel" class="flex flex-col rounded max-w-xs m-4">
            <div class="bg-blue px-3 py-2 text-xl text-white rounded rounded-t border">Settings</div>
            <div class="border-l border-r border-b px-3 py-2">Site</div>
            <div class="border-l border-r border-b px-3 py-2">Api</div>
            <div class="border-l border-r border-b px-3 py-2">Collaborators</div>
            <div class="border-l border-r border-b px-3 py-2 rounded rounded-b">Billing</div>
        </div>
    </div>
    <script src="{{ mix('app.js') }}"></script>
@stop