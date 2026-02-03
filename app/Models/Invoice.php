<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'number',
        'status',
        'issued_at',
        'due_at',
        'paid_at',
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
        'due_at' => 'date',
        'paid_at' => 'date',
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
        return $this->hasMany(InvoiceItem::class);
    }
}
