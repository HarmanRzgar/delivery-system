<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return response()->json($cartItems);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToCart(Request $request, Orders $order)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'item_id' => 'required',
            'name' => 'required|string',
            'price' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Add item to the cart
        $cart = new Cart();
        $cart->item_id = $validatedData['item_id'];
        $cart->name = $validatedData['name'];
        $cart->price = $validatedData['price'];
        $cart->quantity = $validatedData['quantity'];
        $cart->user_id = Auth::id();
        $cart->item_total = $cart->price * $cart->quantity;


//        $cart->update([
//            'total_sum' =>  ($cart->item_total::all() + quantity),
//        ]);
//        $cart->total_sum = $cart->price * $cart->quantity;
        $cart->save();

        // Return a response or perform additional actions
        // ...
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form to add an item to the cart
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        // Show the details of a specific cart item
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        // Show the form to edit a specific cart item
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        // Update the details of a specific cart item
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        // Delete a specific cart item
    }
}
