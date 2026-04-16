<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'description', 'thumbnail_url', 'tags',
        'github_url', 'demo_url', 'type',
        'issuer', 'issued_date', 'cert_url',
        'order', 'is_featured',
    ];

    protected $casts = [
        'tags' => 'array',
        'issued_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function scopeProjects($query)
    {
        return $query->where('type', 'project');
    }

    public function scopeCertifications($query)
    {
        return $query->where('type', 'certification');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }
}
