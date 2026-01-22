<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'favorite_section_id',
        'itemable_type',
        'itemable_id',
        'rank',
        'votes_count',
        'rating',
        'name',
        'slug',
        'description',
        'image',
        'image_alt',
        'price',
        'old_price',
        'cta_text',
        'cta_url',
        'is_hero',
        'order',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_hero' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(FavoriteSection::class, 'favorite_section_id');
    }

    public function itemable()
    {
        return $this->morphTo();
    }

    public function getFormattedPriceAttribute()
    {
        return $this->price !== null ? number_format($this->price, 0, ',', '.') . 'F' : null;
    }

    public function getFormattedOldPriceAttribute()
    {
        return $this->old_price !== null ? number_format($this->old_price, 0, ',', '.') . 'F' : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeHero($query)
    {
        return $query->where('is_hero', true);
    }
}
