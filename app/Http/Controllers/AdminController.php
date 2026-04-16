<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\CareerEntry;
use App\Models\Activity;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AdminController extends Controller
{
    // ─── Login / Logout ─────────────────────────────────────────────────────

    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.profile');
        }
        return view('admin.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.login')->with('error', 'Google authentication failed. Please try again.');
        }

        $allowedEmail = env('ADMIN_ALLOWED_EMAIL', 'zahranfikri2003@gmail.com');

        if ($googleUser->getEmail() !== $allowedEmail) {
            return redirect()->route('admin.login')->with('error', 'Access denied. This admin is private.');
        }

        session([
            'admin_logged_in' => true,
            'admin_name'      => $googleUser->getName(),
            'admin_email'     => $googleUser->getEmail(),
            'admin_avatar'    => $googleUser->getAvatar(),
        ]);

        return redirect()->route('admin.profile')->with('success', 'Welcome back, ' . $googleUser->getName() . '!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_name', 'admin_email', 'admin_avatar']);
        return redirect('/');
    }

    // ─── Profile ────────────────────────────────────────────────────────────

    public function showProfile()
    {
        $profile = Profile::first();
        $skills  = Skill::orderBy('row_number')->orderBy('order')->get()->groupBy('row_number');

        return view('admin.profile', compact('profile', 'skills'));
    }

    public function updateProfile(Request $request)
    {
        $profile = Profile::first();

        $validated = $request->validate([
            'name'              => 'required|string|max:100',
            'bio'               => 'nullable|string|max:1000',
            'taglines_raw'      => 'nullable|string',
            'photo_url'         => 'nullable|string|max:500',
            'cv_url'            => 'nullable|string|max:500',
            'social_github'     => 'nullable|url|max:300',
            'social_linkedin'   => 'nullable|url|max:300',
            'social_twitter'    => 'nullable|url|max:300',
        ]);

        // Parse taglines: one per line
        $taglines = collect(explode("\n", $validated['taglines_raw'] ?? ''))
            ->map(fn($t) => trim($t))
            ->filter()
            ->values()
            ->toArray();

        $profile->update([
            'name'         => $validated['name'],
            'bio'          => $validated['bio'],
            'taglines'     => $taglines,
            'photo_url'    => $validated['photo_url'],
            'cv_url'       => $validated['cv_url'],
            'social_links' => [
                'github'   => $validated['social_github'] ?? '',
                'linkedin' => $validated['social_linkedin'] ?? '',
                'twitter'  => $validated['social_twitter'] ?? '',
            ],
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $file = $request->file('photo');
        $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);

        return response()->json(['url' => '/img/' . $filename]);
    }

    // ─── Skills ─────────────────────────────────────────────────────────────

    public function storeSkill(Request $request)
    {
        if ($request->has('skills') && is_array($request->skills)) {
            $validated = $request->validate([
                'skills' => 'required|array',
                'skills.*.name' => 'required|string|max:100',
                'skills.*.icon_class' => 'required|string|max:200',
                'skills.*.category' => 'nullable|string|max:100',
                'skills.*.row_number' => 'required|integer|in:1,2,3',
                'skills.*.order' => 'required|integer|min:0',
            ]);

            $createdSkills = [];
            foreach ($validated['skills'] as $skillData) {
                $createdSkills[] = Skill::create($skillData);
            }

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'skills' => $createdSkills]);
            }
            return back()->with('success', count($createdSkills) . " skills added!");
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'icon_class' => 'required|string|max:200',
            'category'   => 'nullable|string|max:100',
            'row_number' => 'required|integer|in:1,2,3',
            'order'      => 'required|integer|min:0',
        ]);

        $skill = Skill::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'skill' => $skill]);
        }
        return back()->with('success', "Skill \"{$validated['name']}\" added!");
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'icon_class' => 'required|string|max:200',
            'category'   => 'nullable|string|max:100',
            'row_number' => 'required|integer|in:1,2,3',
            'order'      => 'required|integer|min:0',
        ]);

        $skill->update($validated);
        return back()->with('success', "Skill \"{$skill->name}\" updated!");
    }

    public function destroySkill(Request $request, Skill $skill)
    {
        $name = $skill->name;
        $skill->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => "Skill \"{$name}\" deleted."]);
        }
        return back()->with('success', "Skill \"{$name}\" deleted.");
    }

    // ─── Career ─────────────────────────────────────────────────────────────

    public function showCareer()
    {
        $entries = CareerEntry::ordered()->get();
        return view('admin.career', compact('entries'));
    }

    public function storeCareer(Request $request)
    {
        $validated = $request->validate([
            'company'          => 'required|string|max:200',
            'position'         => 'required|string|max:200',
            'type'             => 'required|string|in:internship,full-time,freelance',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'description_raw'  => 'nullable|string',
            'logo_url'         => 'nullable|string|max:500',
            'order'            => 'nullable|integer|min:0',
            'location'         => 'nullable|string|max:200',
            'skills_raw'       => 'nullable|string',
            'project_title'    => 'nullable|string|max:200',
            'project_url'      => 'nullable|string|max:500',
            'media_urls_raw'   => 'nullable|string',
        ]);

        $description = collect(explode("\n", $validated['description_raw'] ?? ''))
            ->map(fn($t) => trim($t))->filter()->values()->toArray();

        $skills = collect(explode("\n", $validated['skills_raw'] ?? ''))
            ->map(fn($t) => trim($t))->filter()->values()->toArray();

        $media_urls = collect(explode("\n", $validated['media_urls_raw'] ?? ''))
            ->map(fn($t) => trim($t))->filter()->values()->toArray();

        CareerEntry::create([
            'company'       => $validated['company'],
            'position'      => $validated['position'],
            'type'          => $validated['type'],
            'start_date'    => $validated['start_date'],
            'end_date'      => $validated['end_date'],
            'description'   => $description,
            'logo_url'      => $validated['logo_url'],
            'order'         => $validated['order'] ?? 0,
            'location'      => $validated['location'] ?? null,
            'skills'        => empty($skills) ? null : $skills,
            'project_title' => $validated['project_title'] ?? null,
            'project_url'   => $validated['project_url'] ?? null,
            'media_urls'    => empty($media_urls) ? null : $media_urls,
        ]);

        return back()->with('success', 'Career entry added!');
    }

    public function updateCareer(Request $request, CareerEntry $career)
    {
        $validated = $request->validate([
            'company'          => 'required|string|max:200',
            'position'         => 'required|string|max:200',
            'type'             => 'required|string|in:internship,full-time,freelance',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'description_raw'  => 'nullable|string',
            'logo_url'         => 'nullable|string|max:500',
            'order'            => 'nullable|integer|min:0',
            'location'         => 'nullable|string|max:200',
            'skills_raw'       => 'nullable|string',
            'project_title'    => 'nullable|string|max:200',
            'project_url'      => 'nullable|string|max:500',
            'media_urls_raw'   => 'nullable|string',
        ]);

        $description = collect(explode("\n", $validated['description_raw'] ?? ''))
            ->map(fn($t) => trim($t))->filter()->values()->toArray();

        $skills = collect(explode("\n", $validated['skills_raw'] ?? ''))
            ->map(fn($t) => trim($t))->filter()->values()->toArray();

        $media_urls = collect(explode("\n", $validated['media_urls_raw'] ?? ''))
            ->map(fn($t) => trim($t))->filter()->values()->toArray();

        $career->update([
            'company'       => $validated['company'],
            'position'      => $validated['position'],
            'type'          => $validated['type'],
            'start_date'    => $validated['start_date'],
            'end_date'      => $validated['end_date'],
            'description'   => $description,
            'logo_url'      => $validated['logo_url'],
            'order'         => $validated['order'] ?? 0,
            'location'      => $validated['location'] ?? null,
            'skills'        => empty($skills) ? null : $skills,
            'project_title' => $validated['project_title'] ?? null,
            'project_url'   => $validated['project_url'] ?? null,
            'media_urls'    => empty($media_urls) ? null : $media_urls,
        ]);

        return back()->with('success', "Career entry updated!");
    }

    public function destroyCareer(Request $request, CareerEntry $career)
    {
        $career->delete();
        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Career entry deleted.');
    }

    // ─── Activities ─────────────────────────────────────────────────────────

    public function showActivities()
    {
        $activities = Activity::latestFirst()->get();
        return view('admin.activities', compact('activities'));
    }

    public function storeActivity(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:200',
            'category'      => 'required|string|max:100',
            'description'   => 'required|string|max:2000',
            'thumbnail_url' => 'nullable|string|max:500',
            'link_url'      => 'nullable|string|max:500',
            'published_at'  => 'required|date',
        ]);

        Activity::create($validated);
        return back()->with('success', 'Activity added!');
    }

    public function updateActivity(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:200',
            'category'      => 'required|string|max:100',
            'description'   => 'required|string|max:2000',
            'thumbnail_url' => 'nullable|string|max:500',
            'link_url'      => 'nullable|string|max:500',
            'published_at'  => 'required|date',
        ]);

        $activity->update($validated);
        return back()->with('success', 'Activity updated!');
    }

    public function destroyActivity(Request $request, Activity $activity)
    {
        $activity->delete();
        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Activity deleted.');
    }
}
