<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_type',
        'thickness_cm',
        'places',
        'price',
        'old_price',
        'discount_percent',
        'stock',
        'sku',
        'is_active',
    ];

    protected $casts = [
        'thickness_cm' => 'integer',
        'places' => 'decimal:1',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.') . 'F';
    }

    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? number_format($this->old_price, 0, ',', '.') . 'F' : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
