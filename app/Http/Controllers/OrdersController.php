<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;

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
        $user_id = $request->user_id;

        // Check if the user id exists in the orders table
      // $order = Orders::where('customer_id', $user_id)->first();

       // if ($order) {
            // The user id already exists in the orders table, so we need to call the store method in the orderlist controller
         //   (new OrderListController)->store($request->all());
       // } else {
            // The user id does not exist in the orders table, so we need to create a new order
            $order = new Orders();
            $order->customer_id = $user_id;
            $order->save();
       // }
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
