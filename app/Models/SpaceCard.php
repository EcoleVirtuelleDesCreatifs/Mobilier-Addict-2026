<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_section_id',
        'title',
        'description',
        'image',
        'image_alt',
        'cta_text',
        'cta_url',
        'size',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(SpaceSection::class, 'space_section_id');
    }

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
}
