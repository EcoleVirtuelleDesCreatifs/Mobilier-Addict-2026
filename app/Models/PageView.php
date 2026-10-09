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
        'ip',
        'user_agent',
    ];
}
