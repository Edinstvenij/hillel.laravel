@extends('layout')


@section('title')
    Admin Categories Page
@endsection

@section('content')
    <h1>Admin Categories</h1>
    <div class="list-group col-1">
        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
        <a href="{{ route('adminCategoryCreate') }}" class="list-group-item list-group-item-action list-group-item-success">Create</a>
        <a href="{{ route('adminCategoryTrash') }}" class="list-group-item list-group-item-action list-group-item-danger">Trash</a>
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
        @foreach($categories as $category)
            <tr>
                <th>{{ $category->id }}</th>
                <th>{{ $category->title }}</th>
                <th>{{ $category->slug }}</th>
                <th>{{ $category->created_at }}</th>
                <th>{{ $category->updated_at }}</th>
                <th><a href="{{ route('adminCategoryEdit', $category->id) }}">&#9999;</a></th>
                <th><a href="{{ route('adminCategoryDelete', $category->id) }}">&#10060;</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
