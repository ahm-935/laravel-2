<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'phone', 'shipping_address', 'payment_method_id', 'order_status_id'])]
class Order extends Model
{
    public function details()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
