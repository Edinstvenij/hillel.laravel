@extends('layout')


@section('title')
    Admin Tags Page
@endsection

@section('content')
    <h1>Admin Tags</h1>
    <div class="list-group col-1">
        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
        <a href="{{ route('adminTagCreate') }}" class="list-group-item list-group-item-action list-group-item-success">Create</a>
        <a href="{{ route('adminTagTrash') }}" class="list-group-item list-group-item-action list-group-item-danger">Trash</a>
    </div>
    <table class="table mt-2 table-bordered table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <th>{{ $tag->id }}</th>
                <th>{{ $tag->title }}</th>
                <th>{{ $tag->slug }}</th>
                <th>{{ $tag->created_at }}</th>
                <th>{{ $tag->updated_at }}</th>
                <th><a href="{{ route('adminTagEdit', $tag->id) }}">&#9999;</a></th>
                <th><a href="{{ route('adminTagDelete', $tag->id) }}">&#10060;</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
