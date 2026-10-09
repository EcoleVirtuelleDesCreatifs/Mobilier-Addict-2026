<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'badge_icon',
        'title',
        'subtitle',
        'background_color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function cards()
    {
        return $this->hasMany(\App\Models\SpaceCard::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
