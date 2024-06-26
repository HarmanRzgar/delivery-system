<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Models\Cart;
use App\Models\OrderList;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::where('customer_id', Auth::id())->orderBy('phase', 'asc')->get();
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



    public function show()
    {
        if (Auth::guard('web')->user()->role_id === 4) {

            $orders = Orders::where('shop_Owner_Id', Auth::id())->orderBy('phase', 'asc')->get();
            $orderLists = [];

            foreach ($orders as $order) {
                $orderList = OrderList::where('order_id', $order->id)->get();
                $orderLists[$order->id] = $orderList;
            }

            return response()->json([
                'orders' => $orders,
                'orderLists' => $orderLists
            ]);
        } else if  (Auth::guard('web')->user()->role_id === 3){
            $orders = Orders::where('driver_id', Auth::id())->get();
            $undeliveredOrders = Orders::where('phase', 2)->get();
            $orderLists = [];

            foreach ($orders as $order) {
                $orderList = OrderList::where('order_id', $order->id)->get();
                $orderLists[$order->id] = $orderList;
            }

            return response()->json([
                'orders' => $orders,
                'orderLists' => $orderLists,
                'undeliveredOrders' => $undeliveredOrders,
            ]);
        }
    }

    public function updatePhase($OrderId, Request $request )
    {

        $phase = $request->input('phase');

        $order = Orders::findOrFail($OrderId);

        if ($phase === 'accept') {
            // Increase the value of the "phase" column by one
            $order->phase += 1;
        } elseif ($phase === 'reject') {
            // Set the value of the "phase" column to five
            $order->phase = 6;
        } elseif ($phase === 'deliver') {
            // Set the value of the "phase" column to five
            $order->phase = 3;
            $order->driver_id = Auth::id();
        } elseif ($phase === 'done') {
            // Set the value of the "phase" column to five
            $order->phase = 4;
        } elseif ($phase === 'cancel') {
            // Set the value of the "phase" column to five
            $order->phase = 5;
        }

        $order->save();

        return response()->json(['message' => 'Phase updated successfully']);
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
            // Add your validation rules here
        ]);

        // Retrieve cart items for the user
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isNotEmpty()) {
            // Calculate the total sum
            $totalSum = 0;

            $shopOwnerId = $cartItems->first()->shop_owner_id;


            // Create the order
            $order = Orders::create([
                'customer_id' => Auth::id(),
                'total_sum' => $totalSum, // Assign the initial total sum
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
                $orderItem->load('item.user');
                $orderItem->save();

                // Accumulate the total sum
                $totalSum += $cartItem->item->price * $cartItem->quantity;
            }


            // Update the order with the calculated total sum
            $order->total_sum = $totalSum;
            if ($order->shop_owner === null){
            $order->shop_Owner_Id = $shopOwnerId;
            }
            $order->save();

            // Remove cart items
            Cart::where('user_id', Auth::id())->delete();

            // Return a response or perform additional actions
            // ...

            return response()->json(['order' => $order, 'order_item' => $orderItem], 200);
        } else {
            return response()->json(['order' => 'Cart is empty'], 404);
        }
    }



    /**
     * Display the specified resource.
     */



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
