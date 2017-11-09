@extends('app')

@section('body')
    <table>
        <thead>
           <tr>
               <th>Title</th>
               <th>Slug</th>
               <th>Template</th>
               <th>Actions</th>
           </tr>           
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>{{ $page->title }}</tr>
                <tr>{{ $page->slug }}</tr>
                <tr>{{ $page->template->name }}</tr>
                <tr></tr>
            @endforeach
        </tbody>
    </table>
@stop