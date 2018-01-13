@extends('master')
@section('body')
    <div id="sales">
        <sign-up></sign-up>
    </div>
    @routes
    <script src="{{ mix('sales.js') }}"></script>
@stop