@extends('layout')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">create authors</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
            DataTables documentation</a>.
    </p>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Create Author</h6>
            <a href="{{ route('authors.index') }}" class="btn btn-primary btn-sm float-right">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('authors.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Author Name</label>
                    <input type="text" class="form-control @error('authorName') is-invalid @enderror" id="name" name="authorName" placeholder="Enter author name" >
                    @error('authorName')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Author</button>
            </form>
        </div>
    </div>

@endsection