<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'taglines', 'bio', 'photo_url', 'cv_url', 'social_links',
    ];

    protected $casts = [
        'taglines' => 'array',
        'social_links' => 'array',
    ];
}
