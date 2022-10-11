@extends('layout')


@section('title')
    Admin Post edit Page
@endsection

@section('content')
    <h1>Admin Post edit</h1>

    <div class="list-group col-1">
        <a href="{{ route('adminPost') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
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
            <th scope="col">delete</th>
        </tr>
        </thead>
        <tbody>
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
            <th><a href="{{ route('adminPostDelete', $post->id) }}">&#10060;</a></th>
        </tr>
        </tbody>
    </table>


    <form action="{{ route('adminPostUpdate') }}" method="post">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $post->id }}">

        <div class="mb-3">
            <label for="title" class="form-label">Enter title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title')?? $post->title }}" placeholder="Enter title">
            @if($errors->has('title'))
                @foreach($errors->get('title') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>


        <div class="mb-3">
            <label for="body" class="form-label">Enter body</label>
            <textarea class="form-control" name="body" id="body" cols="30" rows="4">{{ old('body')?? $post->body }}</textarea>
            @if($errors->has('body'))
                @foreach($errors->get('body') as $error)
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>


        <div class="mb-3">
            <label for="user_id" class="form-label">Select a author</label>
            <select class="form-select" id="user_id" name="user_id">
                @foreach($users as $user)
                    <option {{ old('user_id')?? $post->user_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @if($errors->has('user_id'))
                @foreach($errors->get('user_id') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Select a category</label>
            <select class="form-select" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option {{  old('category_id')??$post->category_id == $category->id? 'selected' : '' }} value="{{ $category->id == old('category_id')? old('category_id'): $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @if($errors->has('category_id'))
                @foreach($errors->get('category_id') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="tag_id" class="form-label">Select a tag(s) + ctrl</label>
            <select class="form-select" id="tag_id" name="tags_id[]" multiple>
                @foreach($tags as $tag)
                    <option
                        @if(empty(old('tags_id')))
                            @foreach($post->tags as $tag_id)
                                {{ $tag->id == $tag_id->id? 'selected' : '' }}
                            @endforeach
                        @else
                            @foreach(old('tags_id') as $tag_id)
                                {{ $tag->id == $tag_id? 'selected' : '' }}
                            @endforeach
                        @endif
                        value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
            @if($errors->has('tags_id'))
                @foreach($errors->get('tags_id') as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="mt-3 col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection
