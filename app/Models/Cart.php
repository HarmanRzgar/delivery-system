<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'price',
        'item_id',
        'quantity',
        'name',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
