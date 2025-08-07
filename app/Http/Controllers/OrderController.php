<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:owner')->only('index');
        $this->middleware('role:customer')->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::orderBy('id','desc')->get();
        return view('order.list', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth()->user()->id;
        $order->order_number = uniqid();
        $order->phone_number = $request->phone;
        $order->shipping_address = $request->address;
        $order->payment_type =$request->payment;
        $total = 0;
        $itemArray = json_decode($request->itemstring);
        foreach ($itemArray as $item) {
            $total += $item->price * $item->qty;
        }
        $order->total_amount = $total;
        $order->save();
        foreach ($itemArray as $item) {
            $order->books()->attach($item->id,['quantity'=> $item->qty]);
        }
        return response()->json([
            'order'=>$order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('order.deail',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
