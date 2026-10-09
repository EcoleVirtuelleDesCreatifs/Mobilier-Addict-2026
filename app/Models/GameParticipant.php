<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class GameParticipant extends Model
{
    protected $fillable = [
        'lastname',
        'firstnames',
        'whatsapp',
        'city',
        'public_name',
        'photo',
        'prize',
        'slug',
        'badge_path',
        'supports_count',
    ];

    protected $casts = [
        'supports_count' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function generateSlug(string $publicName): string
    {
        $base = Str::slug($publicName) ?: 'participant';
        $slug = $base;
        $i = 1;

        while (static::query()->where('slug', $slug)->exists()) {
            $slug = $base . '-' . (++$i);
        }

        return $slug;
    }

    /**
     * Insère un participant en garantissant l'unicité du slug même en cas
     * de soumissions simultanées : la contrainte unique en base fait foi,
     * et on retente avec un suffixe en cas de collision.
     */
    public static function createWithUniqueSlug(array $attributes): self
    {
        $base = Str::slug($attributes['public_name'] ?? '') ?: 'participant';
        $slug = $base;
        $i = 1;

        while (true) {
            try {
                return static::create($attributes + ['slug' => $slug]);
            } catch (QueryException $e) {
                if (!self::isDuplicateSlug($e) || ++$i > 50) {
                    throw $e;
                }
                $slug = $base . '-' . $i . '-' . Str::lower(Str::random(3));
            }
        }
    }

    private static function isDuplicateSlug(QueryException $e): bool
    {
        $msg = $e->getMessage();

        return in_array($e->getCode(), ['23000', '23505'], true)
            && str_contains($msg, 'slug');
    }

    public function publicUrl(): string
    {
        return route('game.show', $this->slug);
    }
}
