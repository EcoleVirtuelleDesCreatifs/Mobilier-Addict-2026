<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class B2BCategory extends Model
{
    use HasFactory;

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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'b2b_category_product');
    }
}
