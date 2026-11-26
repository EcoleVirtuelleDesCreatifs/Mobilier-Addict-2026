<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'visitor_id',
        'user_id',
        'route_name',
        'path',
        'full_url',
        'referer',
        'source',
        'medium',
        'campaign',
        'ip',
        'country',
        'country_code',
        'region',
        'city',
        'user_agent',
    ];

    /** Pays retenu pour les statistiques (code ISO), ou null pour tous les pays. */
    public static function targetCountry(): ?string
    {
        $code = strtoupper(trim((string) config('maquette.analytics_country', 'CI')));

        return $code === '' ? null : $code;
    }

    /** Limite aux visites localisées dans le pays cible (Côte d'Ivoire par défaut). */
    public function scopeTargetCountry($query)
    {
        static $hasColumn = null;
        $hasColumn ??= \Illuminate\Support\Facades\Schema::hasColumn('page_views', 'country_code');

        $code = static::targetCountry();

        return ($code && $hasColumn) ? $query->where('country_code', $code) : $query;
    }
}
