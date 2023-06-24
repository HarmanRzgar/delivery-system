<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\user;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    public function show($id)
    {
        // Retrieve the shop based on the provided ID or slug
        $shop = User::findOrFail($id);
        $name = User::find($id);
        // Additional logic or data retrieval if needed

        // Return the Inertia response with the shop data
        return Inertia::render('ShopFront');
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
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
