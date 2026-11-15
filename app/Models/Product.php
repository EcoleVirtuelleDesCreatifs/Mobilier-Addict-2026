<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'image',
        'gallery',
        'price',
        'shipping_price',
        'old_price',
        'discount_percent',
        'category_id',
        'badge',
        'badge_type',
        'stock',
        'sku',
        'dimensions',
        'material',
        'color',
        'available_colors',
        'rating',
        'reviews_count',
        'firmness',
        'thickness',
        'size',
        'is_featured',
        'is_bestseller',
        'is_collection',
        'is_active',
        'order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'shipping_price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'available_colors' => 'array',
        'rating' => 'decimal:1',
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_collection' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_product')->withTimestamps();
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function isInStock(?ProductVariant $variant = null): bool
    {
        if (!$this->is_active || ($variant && !$variant->is_active)) {
            return false;
        }

        if ((int) $this->stock > 0) {
            return true;
        }

        return $variant
            ? (int) $variant->stock > 0
            : $this->variants->contains(fn ($row) => $row->is_active && (int) $row->stock > 0);
    }

    public function preferredVariant(): ?ProductVariant
    {
        $variants = $this->variants->where('is_active', true)->sortBy('price');

        return $variants->first(fn ($variant) => (float) $variant->price > 0 && $this->isInStock($variant))
            ?? $variants->first(fn ($variant) => (float) $variant->price > 0)
            ?? $variants->first();
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

    public function scopeBestsellers($query)
    {
        return $query->where('is_bestseller', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeInStock($query)
    {
        return $query->where(function ($q) {
            $q->where($this->qualifyColumn('stock'), '>', 0)
                ->orWhereHas('variants', fn ($variants) => $variants->active()->where('stock', '>', 0));
        });
    }

    public function scopeOutOfStock($query)
    {
        return $query->where($this->qualifyColumn('stock'), '<=', 0)
            ->whereDoesntHave('variants', fn ($variants) => $variants->active()->where('stock', '>', 0));
    }

    public function scopeCollection($query)
    {
        return $query->where('is_collection', true);
    }
}
