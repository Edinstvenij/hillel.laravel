@extends('layout')


@section('title')
    Admin Page
@endsection

@section('content')

    <nav class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action" href="{{ route('adminCategory') }}">Category</a>
        <a class="list-group-item list-group-item-action" href="{{ route('adminPost') }}">Post</a>
        <a class="list-group-item list-group-item-action" href="{{ route('adminTag') }}">Tag</a>
    </nav>

@endsection
