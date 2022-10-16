@extends('layout')


@section('title')
    post Page
@endsection

@section('content')
    <div class="flex">
        <h1>Post page</h1>
    </div>


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
        </tr>
        </thead>
        <tbody>

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
                @endif
                {{ $allRating == 0? 'No rating' : $allRating }}
            </td>
            <td>{{ $post->created_at->isoFormat('YYYY-M-d (dddd)') }}</td>
        </tr>
        </tbody>
    </table>

    <form action="{{ route('postAddRating') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <select name="rating">
            <option> Select rating</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    @if($errors->has('rating'))
        @foreach($errors->get('rating') as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

@endsection
