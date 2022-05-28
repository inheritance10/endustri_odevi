<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','customer_data_id','status', 'product_id'
    ];

    public function order_items()//Tablo birleştirilme işlemi yapıldı..
    {
        return $this->hasMany(OrderItems::class,'order_id');
    }
}
