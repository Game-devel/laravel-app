@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Post</h2>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                <div style="margin-top: 5px;" class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" class="form-control" rows="5">{{ old('body') }}</textarea>
                @error('body')
                <div style="margin-top: 5px;" class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
