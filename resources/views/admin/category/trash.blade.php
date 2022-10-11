@extends('layout')


@section('title')
    Trash Categories Page
@endsection

@section('content')
    <h1>Trash Categories</h1>
    <div class="list-group col-1">
        <a href="{{ route('adminCategory') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
    </div>
    @if(count($categories))
        <table class="table table-bordered table-hover table-dark">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Created_at</th>
                <th scope="col">Updated_at</th>
                <th scope="col">Reestablish</th>
                <th scope="col">Destroy</th>
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
                    <th><a href="{{ route('adminCategoryRestore', $category->id) }}">Restore</a></th>
                    <th><a href="{{ route('adminCategoryForceDelete', $category->id) }}">X</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Empty</p>
    @endif
@endsection
