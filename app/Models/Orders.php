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
        'shop_Owner_Id',
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

    public function shop_owner() {
        return $this->belongsTo(User::class, "shop_Owner_Id");
    }


    use HasFactory;
}
