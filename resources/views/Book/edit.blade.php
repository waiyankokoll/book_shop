@extends('layout')
@section('content')
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
              <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" name="bookName" class="form-control w-50 @error('bookName') is-invalid @enderror" value="{{$book->name}}" id="name" placeholder="...">
                  @error('bookName')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="author" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                  <select name="bookAuthor" class="form-select form-control w-50 @error('bookAuthor') is-invalid @enderror" id="author">
                    <option selected disabled>Choose...</option>
                    @foreach ($authors as $author)
                      <option value="{{$author->id}}" 
                        {{ $book->author_id == $author->id ? 'selected' : ''}}>{{$author->name}}</option>
                    @endforeach
                  </select>
                  @error('bookAuthor')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                  <input type="number" name="bookPrice" class="form-control w-50 @error('bookPrice') is-invalid @enderror" value="{{$book->price}}" id="price" placeholder="...">
                  @error('bookPrice')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="category" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                  <select name="bookCategory" class="form-select form-control w-50 @error('bookCategory') is-invalid @enderror" id="category">
                    <option selected disabled>Choose...</option>
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}" 
                        {{ $book->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                  </select>
                  @error('bookCategory')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" name="bookImage" class="form-control-file w-50 @error('bookImage') is-invalid @enderror" value="{{$book->image}}" id="image" placeholder="...">
                  @if ($book->image)
                    <div class="mt-2">
                      <img src="{{ asset($book->image) }}" alt="Current Book Image" width="120" style="border: 1px solid #ccc; border-radius: 5px;">
                    </div>
                  @endif
                  @error('bookImage')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <textarea name="bookDescription" class="form-control w-50 @error('bookDescription') is-invalid @enderror" id="description">{{$book->description}}</textarea>
                  @error('bookDescription')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
              </div>
            
        </div>
@endsection

