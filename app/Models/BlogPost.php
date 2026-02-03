<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'image_alt',
        'published_at',
        'reading_time',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoryIdAttribute()
    {
        return $this->blog_category_id;
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['blog_category_id'] = $value;
    }

    public function getStatusAttribute()
    {
        return $this->published_at ? 'published' : 'draft';
    }

    public function getViewsAttribute()
    {
        if (Schema::hasColumn('blog_posts', 'views_count')) {
            return (int) ($this->attributes['views_count'] ?? 0);
        }

        return 0;
    }

    public function getIsSliderAttribute()
    {
        if (Schema::hasColumn('blog_posts', 'is_slider')) {
            return (bool) ($this->attributes['is_slider'] ?? false);
        }

        return false;
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
}
