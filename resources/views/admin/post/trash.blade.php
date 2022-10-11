@extends('layout')


@section('title')
    Trash Posts Page
@endsection

@section('content')
    <h1>Trash Posts</h1>
    <div class="list-group col-1">
        <a href="{{ route('adminPost') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
    </div>
    @if(count($posts))
        <table class="table table-bordered table-hover table-dark">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Author</th>
                <th scope="col">Tags</th>
                <th scope="col">Created_at</th>
                <th scope="col">Updated_at</th>
                <th scope="col">Reestablish</th>
                <th scope="col">Destroy</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th>{{ $post->id }}</th>
                    <th>{{ $post->title }}</th>
                    <th>{{ $post->body }}</th>
                    <th>{{ $post->users->name }}</th>
                    <th>@foreach($post->tags as $tag)
                            {!! $tag->title . '<br>' !!}
                        @endforeach
                    </th>
                    <th>{{ $post->created_at }}</th>
                    <th>{{ $post->updated_at }}</th>
                    <th><a href="{{ route('adminPostRestore', $post->id) }}">Restore</a></th>
                    <th><a href="{{ route('adminPostForceDelete', $post->id) }}">X</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Empty</p>
    @endif
@endsection
