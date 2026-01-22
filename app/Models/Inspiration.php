<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge',
        'title',
        'slug',
        'description',
        'image',
        'image_alt',
        'btn_text',
        'btn_url',
        'size',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeLarge($query)
    {
        return $query->where('size', 'large');
    }

    public function scopeSmall($query)
    {
        return $query->where('size', 'small');
    }
}
