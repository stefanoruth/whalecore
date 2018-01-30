@extends('master')

@section('body')
    <div id="sales">
        <router-view></router-view>
    </div>
    @routes
    <script src="{{ mix('sales.js') }}"></script>
@stop