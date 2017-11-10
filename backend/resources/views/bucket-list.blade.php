@extends('app')

@section('body')
    <div class="container mx-auto">
        <table border="1" class="w-full">
            <thead>
                 <tr>
                     <th>Title</th>
                     <th>Template</th>
                     <th>Actions</th>
                 </tr>           
            </thead>
            <tbody>
                @foreach($buckets as $bucket)
                    <tr>
                        <td>{{ $bucket->name }}</td>
                        <td>{{ $bucket->template->name }}</td>
                        <td>
                            <a href="{{ route('buckets.edit', $bucket->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $buckets->links() }}

        <button>New Bucket</button>
    </div>
@stop