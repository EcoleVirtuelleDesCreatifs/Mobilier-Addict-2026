<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'special_badge',
        'title',
        'slug',
        'description',
        'image',
        'image_alt',
        'price_from',
        'old_price',
        'price_label',
        'btn_text',
        'btn_url',
        'product_type',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'price_from' => 'decimal:2',
        'old_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price_from, 0, ',', '.') . 'F';
    }

    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price ? number_format($this->old_price, 0, ',', '.') . 'F' : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('product_type', $type);
    }
}
