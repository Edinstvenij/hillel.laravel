@extends('layout')


@section('title')
    Admin Categories Create Page
@endsection

@section('content')
    <h1>Admin Categories Create</h1>

    <div class="list-group col-1">
        <a href="{{ route('adminCategory') }}" class="list-group-item list-group-item-action list-group-item-dark">Back</a>
    </div>

    <form action="{{ route('adminCategoryStore') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Enter title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter title">
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
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Enter slug">
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
