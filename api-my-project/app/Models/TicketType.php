<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketType extends Model
{
   protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quantity',
        'available_quantity',
        'sale_start',
        'sale_end',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'available_quantity' => 'integer',
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
    