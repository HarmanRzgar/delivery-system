<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Models\Cart;
use App\Models\OrderList;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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
        // Validate the request data
        $validatedData = $request->validate([

        ]);

        // Retrieve cart items for the user
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Create the order
        $order = new Orders();
        $order->customer_id = Auth::id();
        $order->total_sum = 0; // This will be updated in the loop
        $order->phase = 1; // Set the initial status of the order

        $order->save();


        // Move cart items to order
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderList();
            $orderItem->order_id = $order->id;
            $orderItem->item_id = $cartItem->item_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->save();


            // Update the order total by multiplying item price with quantity
            $order->total_sum += ($cartItem->item->price * $cartItem->quantity);
        }


        // Save the updated order total
        $order->save();

        // Remove cart items
        Cart::where('user_id', Auth::id())->delete();

        // Return a response or perform additional actions
        // ...
    }



    /**
     * Display the specified resource.
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orders $orders)
    {
        //
    }
}
