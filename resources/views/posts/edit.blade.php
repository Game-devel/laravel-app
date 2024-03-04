<?php
/**
 *
 * @var \App\Models\post\Post $post
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Post</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                @error('title')
                <div style="margin-top: 5px;" class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" class="form-control" rows="5">{{ $post->body }}</textarea>
                @error('body')
                <div style="margin-top: 5px;" class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
