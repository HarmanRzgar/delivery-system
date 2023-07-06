<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ItemFactory;


class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'discountPercentage',
        'price',
        'image'
    ];

    function user(){
        return $this->belongsTo(Item::class, 'userId');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Database\Factories\ItemFactory
     */
    protected static function newFactory()
    {
        return ItemFactory::new();
    }
}
