<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'number',
        'status',
        'issued_at',
        'expires_at',
        'lastname',
        'firstnames',
        'whatsapp',
        'phone',
        'delivery_place',
        'delivery_day',
        'details',
        'subtotal',
        'shipping_amount',
        'total',
        'notes',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
        'delivery_day' => 'date',
        'subtotal' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }
}
