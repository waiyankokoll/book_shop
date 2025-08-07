@extends('frontend.layout')
@section('content')
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 fw-bold">Shopping Cart</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Book</th>
                                <th scope="col" >QTY</th>
                                <th scope="col">Price</th>
                                <th scope="col">Amount</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                <th scope="row" class="align-middle">1</th>
                                <td class="fw-bold ">
                                    <img src="{{asset('frontend/image/wave.jpg')}}" alt="" style="width: 9%" class="align-middle">
                                    Mark</td>
                                <td class="align-middle"><input type="number" name="" id="" class="form-control w-50"></td>
                                <td class="align-middle">@mdo</td>
                                <td class="align-middle">0000</td>
                                <td  class="align-middle">
                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    
                                </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="fw-bold" align="right">Total : </td>
                                    <td>552222</td>
                                    <td></td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <a href="{{route('homepage')}}" id="return_home" class="text-decoration-none fw-bold"><< continue to Product Page </a>

                    </div>
                    <div class="col-md-4">
                        <form action="" method="POST" onsubmit="return checkout()">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h2 class="fw-bold card-title">Payment Info</h2>
                                    <div class="container">
                                        <hr>

                                    </div>
                                    <div class="mb-3 card-body">
                                        <p><label for="" class="form-label text-secondary mb-0">Payment Method:</label></p>
                                        {{-- <div class="form-check">
                                            <input type="radio" name="paymentMethod" id="creditCard" class="form-check-input" value="creditCard">
                                            <i class="fa-solid fa-credit-card"></i> 
                                            <label for="creditCard" class="form-label fs-6 fw-bold">Credit Card</label>
                                        </div> --}}
                                        <div class="form-check mt-0">
                                            <input type="radio" name="paymentMethod" id="kbzPay" class="form-check-input" value="kpay">
                                            <img src="{{asset('frontend/image/kbzpay.jpg')}}" alt="KBZPay" class="" style="width: 8%;">
                                            <label for="kbzPay" class="form-label fs-6 fw-bold" >KBZ Pay</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input type="radio" name="paymentMethod" id="wavePay" class="form-check-input"  value="wave">
                                            <img src="{{asset('frontend/image/wave.jpg')}}" alt="KBZPay" class="" style="width: 8%;">
                                            <label for="wavePay" class="form-label fs-6 fw-bold">Wave Pay</label>
                                        </div>
                                        {{-- <div id="creditCardInput" class="d-none ">
                                            <label for="cardNumber" class="form-label text-secondary mt-2">Card Number :</label>
                                            <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                        </div> --}}
                                        
                                        <div class=" mt-3 w-100">
                                            <label for="phone" class="form-label text-secondary mt-2">Phone Number :</label>
                                            <input type="number" name=""  class="form-control" placeholder="Phone Number" id="phone">

                                        
                                        {{-- address --}}
                                            <div class=" mt-2">
                                                <label for="address" class="form-label text-secondary mt-2"> Address :</label>
                                                <textarea name=""  cols="30" rows="" class="form-control" placeholder="Address" id="address" ></textarea>

                                            </div>

                                        </div>
                                        @guest
                                        <a href="/login" class="btn w-100 btn-primary mt-5 mb-0">Login To Check Out</a>
                                        @else
                                        <button type="submit" class="btn w-100 btn-primary mt-5 mb-0" @role('owner') disabled @endrole>Check Out</button>
                                        @role('owner')
                                            <p class="text-danger">Your an owner</p> 
                                        @endrole
                                        @endguest
                                        

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                        
                    
                </div>
            </div>
        </section>
        
        

@endsection
@section('script')
        <script>
            function checkout(){
                
                let payment = $('input[name= "paymentMethod"]:checked').val();
                let phone = $('#phone').val();
                let address = $('#address').val();                
                let itemstring = localStorage.getItem('bookCart');

                if (payment == null) {
                    alert ("please selet patment method")
                }else if (phone == '') {
                    alert ("please enter Phone number")
                }else if (address == '') {
                    alert ("please enter address ")
                }else if (!itemstring || itemstring == '') {
                    alert ("empty cart list")
                }
                console.log(payment + ' ' + phone + ' ' + address + itemstring);
                $.post('{{route('orders.store')}}' , {
                    _token: '{{csrf_token()}}',
                    _method: 'POST',
                    payment:payment,
                    phone:phone,
                    address:address,
                    itemstring:itemstring
                }).done(function(data){
                    console.log("OK OK -->" , data);
                    localStorage.clear();
                    $('#item-count').text('0')
                    $('tbody').html('<tr><td colspan="6" class="text-center">Order successfull</td></tr>');
                    $('#phone').val('');
                    $('#address').val(''); 
                    
                    
                }).fail(function(data){
                    console.log("failed -->" , data);
                    alert("Fail to checkout")
                    
                })
                

                //alert(payment + ' ' + phone + ' ' + address);
                return false
            }
        </script>
    
@endsection