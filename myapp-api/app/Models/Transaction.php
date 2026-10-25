<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'amount', 'address', 'status', 'transaction_id', 'currency'])]
class Transaction extends Model
{
    //
}
