@extends('layout')


@section('title')
    Admin Categories Edit Page
@endsection

@section('content')
    <h1>Admin Categories Edit</h1>
    <div class="list-group col-1">
        <a href="{{ route('adminCategory') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
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
            <th>{{ $category->id }}</th>
            <th>{{ $category->title }}</th>
            <th>{{ $category->slug }}</th>
            <th>{{ $category->created_at }}</th>
            <th>{{ $category->updated_at }}</th>
            <th><a href="{{ route('adminCategoryDelete', $category->id) }}">&#10060;</a></th>
        </tr>
        </tbody>
    </table>

    <form action="{{ route('adminCategoryUpdate') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $category->id }}">
        <div class="mb-3">
            <label for="title" class="form-label">Enter title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$category->title) }}" placeholder="Enter title">
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
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug',$category->slug) }}" placeholder="Enter slug">
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
