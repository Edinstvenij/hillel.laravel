@extends('layout')


@section('title')
    Admin Posts Page
@endsection

@section('content')
    <h1>Admin Posts</h1>
    <div class="list-group col-1">
        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
        <a href="{{ route('adminPostCreate') }}" class="list-group-item list-group-item-action list-group-item-success">Create</a>
        <a href="{{ route('adminPostTrash') }}" class="list-group-item list-group-item-action list-group-item-danger">Trash</a>
    </div>
    <table class="table mt-2 table-bordered table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Author</th>
            <th scope="col">Tags</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
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
                <th><a href="{{ route('adminPostEdit', $post->id) }}">&#9999;</a></th>
                <th><a href="{{ route('adminPostDelete', $post->id) }}">&#10060;</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
