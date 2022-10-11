@extends('layout')


@section('title')
    Admin Post Create Page
@endsection

@section('content')
    <h1>Admin Post Create</h1>

    <div class="list-group col-1">
        <a href="{{ route('adminPost') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
    </div>

    <form action="{{ route('adminPostStore') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Enter title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter title">
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
            <textarea class="form-control" name="body" id="body" cols="30" rows="4">{{ old('body') }}</textarea>
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
                    <option {{ $user->id == old('user_id')? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
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
                    <option {{ $category->id == old('category_id')? 'selected' : '' }} value="{{ $category->id == old('category_id')? old('category_id'): $category->id }}">{{ $category->title }}</option>
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
                           @if(!empty(old('tags_id'))) @foreach(old('tags_id') as $tag_id)
                                {{ $tag->id == $tag_id? 'selected' : '' }}
                            @endforeach @endif
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
