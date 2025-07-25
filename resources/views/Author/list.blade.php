@extends('layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Authors list</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

                @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                <strong>{{session('success')}}</strong>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4 fade show">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Authors</h6>
                <a href="{{ route('authors.create') }}" class="btn btn-primary btn-sm float-right">Add Author</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Books Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->books->count() }}</td>
                                <td>
                                    <a href="{{ route('authors.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @if($item->books->count() > 0)
                                        <button type="button" class="btn btn-danger btn-sm" onclick="alert('You cannot delete this author because it has books');">Delete</button>
                                    @else
                                    <form action="{{ route('authors.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this author?');">Delete</button>
                                    </form>

                                    @endif

                                    
                                </td>
                            </tr>
                            
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection