<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B2BCategory extends Model
{
    protected $table = 'b2b_categories';

    protected $fillable = [
        'key',
        'name',
        'description',
        'color',
        'is_active',
        'min_products',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
