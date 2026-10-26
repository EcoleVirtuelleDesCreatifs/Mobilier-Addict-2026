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
}
