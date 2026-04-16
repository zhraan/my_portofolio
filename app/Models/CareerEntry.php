<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerEntry extends Model
{
    protected $fillable = [
        'company', 'position', 'type', 'start_date', 'end_date',
        'description', 'logo_url', 'media_urls', 'order',
        'location', 'skills', 'project_title', 'project_url'
    ];

    protected $casts = [
        'description' => 'array',
        'media_urls'  => 'array',
        'skills'      => 'array',
        'start_date'  => 'date',
        'end_date'    => 'date',
    ];

    protected $appends = ['duration'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Computed duration string, e.g. "Jan 2024 – Present (1 Year 3 Month)"
     */
    public function getDurationAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end = $this->end_date ? $this->end_date->format('M Y') : 'Present';

        $endDate = $this->end_date ?? now();
        $diff = $this->start_date->diff($endDate);
        $parts = [];
        if ($diff->y > 0) $parts[] = $diff->y . ' Year';
        if ($diff->m > 0) $parts[] = $diff->m . ' Month';
        if (empty($parts)) $parts[] = '< 1 Month';

        return "{$start} – {$end} (" . implode(' ', $parts) . ")";
    }
}
