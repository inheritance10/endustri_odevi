<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'model_id',
        'name',
        'capacity',
        'hour',
        'description',
        'license',
        'license_plate',
        'examination_date',
        'credit_amount',
        'price',
        'using_status',
        'status',
        'sold_date',
    ];
}
