<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['order_id', 'product_id', 'quantity'])]
class OrderDetails extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
