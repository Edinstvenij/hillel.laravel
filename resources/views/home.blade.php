@extends('layout')


@section('title')
    Home Page
@endsection

@section('content')
    <div class="flex">
        <h1>Home page</h1>
        @cannot('login', \App\Models\Post::class)
            <a href="{{ route('authLogin') }}">login</a>
        @endcannot
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item  @if($posts->onFirstPage()) {{ 'disabled' }} @endif"><a class="page-link" href="{{ $posts->previousPageUrl() }}">Previous</a></li>
            @if(!$posts->onFirstPage())
                <li class="page-item"><a class="page-link" href="{{ $posts->url(1) }}">{{ 1 }}</a></li>
                <li class="page-item"><a class="page-link" href="{{ $posts->previousPageUrl() }}">{{ $posts->currentPage() - 1 == 0? '' : $posts->currentPage() - 1}}</a></li>
            @endif
            <li class="page-item active"><a class="page-link">{{ $posts->currentPage() }}</a></li>
            @if($posts->currentPage() + 1 < $posts->lastPage())
                <li class="page-item"><a class="page-link" href="{{ $posts->url($posts->currentPage() + 1) }}">{{ $posts->currentPage() + 1 }}</a></li>
            @endif
            @if($posts->currentPage() + 2 < $posts->lastPage())
                <li class="page-item"><a class="page-link" href="{{ $posts->url($posts->currentPage() + 2) }}">{{ $posts->currentPage() + 2 }}</a></li>
            @endif
            @if($posts->currentPage() < $posts->lastPage())
                <li class="page-item"><a class="page-link" href="{{ $posts->url($posts->lastPage()) }}">{{ $posts->lastPage()}}</a></li>
            @endif
            <li class="page-item  @if($posts->lastPage() == $posts->currentPage()) {{ 'disabled' }} @endif"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a></li>
        </ul>
    </nav>

    <table class="table table-bordered table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Title</th>
            <th scope="col">Author name</th>
            <th scope="col">Category</th>
            <th scope="col">Body</th>
            <th scope="col">Tag title</th>
            <th scope="col">Rating</th>
            <th scope="col">Updated_at</th>
            <th scope="col">Show</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)

            <tr>
                <th scope="row">{{ $post->id }}</th>
                <th>{{ $post->title }}</th>
                <td><a style="color: dodgerblue; text-decoration: none" href="{{ route('author', $post->users->id)  }}">{{ $post->users->name }}</a></td>
                <td><a style="color: dodgerblue; text-decoration: none" href="{{ route('category', $post->categories->id)  }}">{{ $post->categories->title }}</a></td>
                <td>{{ $post->body }}</td>
                <td>@foreach($post->tags as $tag)
                        <a style="color: dodgerblue; text-decoration: none" href="{{ route('tag', $tag->id)  }}">
                            {!!  htmlspecialchars($tag->title, ENT_QUOTES) .'<br>' !!}
                        </a>
                    @endforeach</td>
                <td>
                    @php($allRating = 0)
                    @if(count($post->ratings) > 1)
                        @foreach($post->ratings as $rating)
                            @php($allRating += $rating->rating)
                        @endforeach
                        @php($allRating = round($allRating / count($post->ratings), 1))
                    @else
                        @foreach($post->ratings as $rating)
                            @php($allRating = $rating->rating)
                        @endforeach
                    @endif
                    {{ $allRating == 0? 'No rating' : $allRating }}
                </td>
                <td>{{ $post->created_at->isoFormat('YYYY-M-d (dddd)') }}</td>
                <td><a href="{{ route('postShow', $post->id) }}">{{ 'show' }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
