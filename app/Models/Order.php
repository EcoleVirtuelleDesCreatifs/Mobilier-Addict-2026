<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'payment_method',
        'shipping_method',
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
    ];

    protected $casts = [
        'delivery_day' => 'date',
        'subtotal' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
