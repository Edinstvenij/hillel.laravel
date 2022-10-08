@extends('layout')


@section('title')
    Home Page
@endsection

@section('content')
    <table class="table table-bordered table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Title</th>
            <th scope="col">Author name</th>
            <th scope="col">Category</th>
            <th scope="col">Body</th>
            <th scope="col">Tag title</th>
            <th scope="col">Updated_at</th>
        </tr>
        </thead>
        <tbody>
        @php($index = 1)
        @foreach($posts as $post)

            <tr>
                <th scope="row">{{ $index++ }}</th>
                <th scope="row">{{ $post->title }}</th>
                <td>{{ $post->users->name }}</td>
                <td>{{ $post->categories->title }}</td>
                <td>{{ $post->body }}</td>
                <td>@foreach($post->tags as $tag)
                        {!!  htmlspecialchars($tag->title, ENT_QUOTES) .'<br>' !!}
                    @endforeach</td>
                <td>{{ $post->created_at->isoFormat('YYYY-M-d (dddd)') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
