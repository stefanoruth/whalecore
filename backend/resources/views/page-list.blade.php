@extends('app')
@section('title', 'Pages')
@section('pageTitle', 'Pages')

@section('body')
    <div class="container mx-auto">
        <table border="1" class="w-full">
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
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ $page->template->name }}</td>
                        <td>
                            <a href="{{ route('pages.edit', $page->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pages->links() }}

        <button>New Page</button>
    </div>
@stop