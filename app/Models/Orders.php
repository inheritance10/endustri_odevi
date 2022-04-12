<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','customer_data_id','status'
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItems::class,'order_id');
    }
}
