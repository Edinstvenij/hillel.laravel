@extends('layout')


@section('title')
    Admin Tag Edit Page
@endsection

@section('content')
    <h1>Admin Tag Edit</h1>
    <div class="list-group col-1">
        <a href="{{ route('adminTag') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
    </div>
    <table class="table table-bordered table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
            <th scope="col">delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>{{ $tag->id }}</th>
            <th>{{ $tag->title }}</th>
            <th>{{ $tag->slug }}</th>
            <th>{{ $tag->created_at }}</th>
            <th>{{ $tag->updated_at }}</th>
            <th><a href="{{ route('adminTagDelete', $tag->id) }}">&#10060;</a></th>
        </tr>
        </tbody>
    </table>

    <form action="{{ route('adminTagUpdate') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $tag->id }}">
        <div class="mb-3">
            <label for="title" class="form-label">Enter title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$tag->title) }}" placeholder="Enter title">
        </div>
        @if($errors->has('title'))
            @foreach($errors->get('title') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class=" mb-3">
            <label for="slug" class="form-label">Enter slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug',$tag->slug) }}" placeholder="Enter slug">
        </div>
        @if($errors->has('slug'))
            @foreach($errors->get('slug') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection
