<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title', 'category', 'description', 'thumbnail_url', 'link_url', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}
