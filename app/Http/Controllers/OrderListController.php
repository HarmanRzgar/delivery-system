<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
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
        $orderList = new OrderList();

    }

    /**
     * Display the specified resource.
     */
    public function show(OrderList $orderList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderList $orderList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderList $orderList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderList $orderList)
    {
        //
    }
}
