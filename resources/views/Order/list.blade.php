@extends('layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">categories list</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">All Order</h6>
                {{-- <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">Add Category</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Vocher No</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Payment Type</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->order_number }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ $item->shipping_address }}</td>
                                <td>{{ $item->payment_type }}</td>
                                <td>{{ $item->total_amount }}</td>
                                
                                <td>    

                                    <a href="{{ route('orders.show', $item->id) }}" class="btn btn-warning btn-sm">view</a>
                                    
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