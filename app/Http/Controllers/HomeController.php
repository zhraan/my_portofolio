<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\CareerEntry;
use App\Models\Activity;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $skillRows = [
            1 => Skill::where('row_number', 1)->orderBy('order')->get(),
            2 => Skill::where('row_number', 2)->orderBy('order')->get(),
            3 => Skill::where('row_number', 3)->orderBy('order')->get(),
        ];

        // Group career entries by company for multi-role timeline rendering
        $rawEntries = CareerEntry::ordered()->get();
        $careerGroups = [];
        $seen = [];

        foreach ($rawEntries as $entry) {
            $key = $entry->company;
            if (!isset($seen[$key])) {
                $seen[$key] = count($careerGroups);
                $careerGroups[] = [
                    'company'   => $entry->company,
                    'logo_url'  => $entry->logo_url,
                    'location'  => $entry->location,
                    'type'      => $entry->type,
                    'entries'   => [$entry],
                ];
            } else {
                $careerGroups[$seen[$key]]['entries'][] = $entry;
            }
        }

        $activities    = Activity::latestFirst()->get();
        $portfolioProjects      = Portfolio::projects()->ordered()->get();
        $portfolioCertifications = Portfolio::certifications()->ordered()->get();

        return view('pages.home', compact(
            'profile', 'skillRows', 'careerGroups', 'activities',
            'portfolioProjects', 'portfolioCertifications'
        ));
    }
}
