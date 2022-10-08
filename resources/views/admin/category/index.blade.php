@extends('layout')


@section('title')
    Admin Categories Page
@endsection

@section('content')
    <h1>Admin Categories</h1>
    <table class="table table-bordered table-hover table-dark">
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
                <th><a href="#">&#9999;</a></th>
                <th><a href="#">&#10060;</a></th>
        </tr>
            @endforeach
        </tbody>
    </table>

@endsection
