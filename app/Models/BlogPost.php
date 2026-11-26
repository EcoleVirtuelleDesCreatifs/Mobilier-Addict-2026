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

    public function getImageUrlAttribute(): string
    {
        $url = $this->image ? image_url($this->image) : null;

        // Image absente (fichier non envoyé sur le serveur, article sans visuel) :
        // visuel de la bibliothèque du site, choisi selon le sujet de l'article.
        if (! $url || str_contains($url, 'product-placeholder')) {
            return asset($this->fallbackImage());
        }

        return $url;
    }

    /** Visuel de remplacement cohérent avec le thème de l'article (stable pour un même article). */
    public function fallbackImage(): string
    {
        $text = mb_strtolower($this->title . ' ' . $this->slug);
        $pools = [
            'appart|meubl|salon|canap|studio|location' => ['appart-essentiel', 'appart-residence', 'appart-standing', 'appartement-cover', 'studio-cover'],
            'hôtel|hotel|résidence|residence' => ['hotellerie-cover', 'hotellerie-essentielle', 'hotellerie-premium'],
            'enfant|bébé|bebe|ado' => ['famille-enfants'],
        ];
        $pool = ['famille-parentale', 'famille-amis', 'famille-cover', 'hotellerie-cover', 'hotellerie-essentielle', 'studio-actif'];
        foreach ($pools as $pattern => $images) {
            if (preg_match('/' . $pattern . '/u', $text)) {
                $pool = $images;
                break;
            }
        }

        return 'assets/maquette/img/blog/' . $pool[abs(crc32((string) ($this->slug ?: $this->id))) % count($pool)] . '.webp';
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
