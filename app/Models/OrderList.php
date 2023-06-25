<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $fillable = [
        'order_id',
        'item_name',
        'item_id',
        'quantity',
        'name',
       'price',
        // additional attributes related to the item in the order
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
