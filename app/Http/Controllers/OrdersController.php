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
        $orders = Orders::where('customer_id', Auth::id())->get();
        $orderLists = [];

        foreach ($orders as $order) {
            $orderList = OrderList::where('order_id', $order->id)->get();
            $orderLists[$order->id] = $orderList;
        }

        return response()->json([
            'orders' => $orders,
            'orderLists' => $orderLists
        ]);
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
        if ($cartItems) {
            // Create the order
            $order = Orders::create([
                'customer_id' => Auth::id(),
                'total_sum' => 10.3, // This will be updated in the loop
                'phase' => 1, // Set the initial status of the order
            ]);


            // Move cart items to order
            foreach ($cartItems as $cartItem) {
                $orderItem = OrderList::create([
                    'order_id' => $order->id,
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'name' => $cartItem->name,
                ]);
                $orderItem->load('item');
                $orderItem->save();


                // Update the order total by multiplying item price with quantity
                $order->update([
                    'total_sum' => ($cartItem->item->price * $cartItem->quantity),
                ]);

            }

            $order->load('phase');


            // Save the updated order total
            $order->save();

            // Remove cart items
            Cart::where('user_id', Auth::id())->delete();

            // Return a response or perform additional actions
            // ...

            return response()->json(['order' => $order], 200);
        } else {
            return response()->json(['order' => 'Cart is empty'], 404);
        }
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
