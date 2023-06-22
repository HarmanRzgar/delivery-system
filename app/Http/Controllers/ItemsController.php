<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Item::all();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Item::where('userId', $id)->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Items/Create');
    }

    public function store(ItemRequest $request)
    {
        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->file('image')->store('items'),
            'user_id' => auth()->id(),
        ]);

        $item->user()->associate(User::find(auth()->id()));
        $item->save();

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $items)
    {
        //
    }
}
