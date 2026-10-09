<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveTheDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'order',
    ];

    public function article()
    {
        return $this->belongsTo(BlogPost::class, 'article_id');
    }
}
