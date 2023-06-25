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

    use HasFactory;
}
