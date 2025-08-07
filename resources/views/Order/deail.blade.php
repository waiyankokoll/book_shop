@extends('layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        
        <div class=" py-3 d-flex align-items-center justify-content-between">
            <h1 class="h3 mb-2 text-gray-800">Book Details</h1>
            <a href="{{ route('books.index') }}" class="btn btn-primary btn float-right">Back</a>
        </div>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        {{-- <h2><strong>Book Name:</strong> {{ $book->name }}</h2>
        <p><strong>Author:</strong> {{ $book->author->name }}</p>
        <p><strong>Price:</strong> ${{ $book->price }}</p>
        <p><strong>Category:</strong> {{ $book->category->name }}</p>
        <p><strong>Description:</strong>{{ $book->description }}</p> --}}
       
            
       
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>sub total</th>
                </tr>
            </thead>
            <tbody>
        @php $total = 0; @endphp
        @foreach ($order->books as $item)
        @php 
          $sub_total = $item->price * $item->pivot->quantity;
          $total += $sub_total;
        @endphp
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{number_format($item->price)}}</td>
            <td>{{$item->pivot->quantity}}</td>
            <td>{{number_format($sub_total)}}</td>
          </tr>
        @endforeach
          <tr>
            <td colspan="4" align="right">Total</td>
            <td>{{number_format($total)}}</td>
          </tr>
      </tbody>
        </table>
        

    </div>
@endsection

