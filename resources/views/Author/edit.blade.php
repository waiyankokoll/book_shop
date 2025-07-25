@extends('layout')
@section('content')
    <h1>Edit Author</h1>
    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="authorName">Author Name</label>
            <input type="text" name="authorName" id="authorName" class="form-control" value="{{ $author->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Author</button>
    </form>
@endsection