@extends('layout')


@section('title')
    Trash Tags Page
@endsection

@section('content')
    <h1>Trash Tags</h1>
    <div class="list-group col-1">
        <a href="{{ route('adminTag') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
    </div>
    @if(count($tags))
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
            @foreach($tags as $tag)
                <tr>
                    <th>{{ $tag->id }}</th>
                    <th>{{ $tag->title }}</th>
                    <th>{{ $tag->slug }}</th>
                    <th>{{ $tag->created_at }}</th>
                    <th>{{ $tag->updated_at }}</th>
                    <th><a href="{{ route('adminTagRestore', $tag->id) }}">Restore</a></th>
                    <th><a href="{{ route('adminTagForceDelete', $tag->id) }}">X</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Empty</p>
    @endif
@endsection
