<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    /**
     * Get the post that owns the comment.
     */
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
