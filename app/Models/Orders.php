<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $fillable = [
      'total_sum',
        'phase',
      'customer_id',
    ];


    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Orders::class, Item::class);
    }


    use HasFactory;
}
