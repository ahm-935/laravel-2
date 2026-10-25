<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // dd($request->all());
        // dd($items);
        $items = json_decode($request->items);
        $order = Order::create([
                    'name'              => $request->name,
                    'phone'             => $request->phone,
                    'shipping_address'  => $request->shipping_address,
                    'payment_method_id' => $request->payment_method,
                    'order_status_id'   => $request->order_status ? $request->order_status : 1,
                ]);
        foreach($items as $item){
            $order->details()->create([
                'product_id' => $item->id,
                'quantity'   => $item->quantity,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Your order has been placed. Thanks for shoping with us.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
