@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Career</h1>
        <p class="admin-page-subtitle">Manage your career journey timeline entries</p>
    </div>
    <button type="button" class="admin-btn admin-btn--primary admin-btn--sm" onclick="document.getElementById('add-career-form').classList.toggle('hidden')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Entry
    </button>
</div>

{{-- Add Career Form (hidden by default) --}}
<div id="add-career-form" class="admin-card hidden" style="margin-bottom:1.5rem;">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Career Entry
        </div>
    </div>
    <form method="POST" action="{{ route('admin.career.store') }}" class="admin-form" style="padding:1.25rem;">
        @csrf
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label class="admin-label">Company</label>
                <input type="text" name="company" class="admin-input" required placeholder="PT Telkom Indonesia">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Position</label>
                <input type="text" name="position" class="admin-input" required placeholder="Data Science Intern">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Type</label>
                <select name="type" class="admin-input" required>
                    <option value="internship">Internship</option>
                    <option value="full-time">Full-time</option>
                    <option value="freelance">Freelance</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Order</label>
                <input type="number" name="order" class="admin-input" value="0" min="0">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Start Date</label>
                <input type="date" name="start_date" class="admin-input" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-label">End Date <small>(leave empty for "Present")</small></label>
                <input type="date" name="end_date" class="admin-input">
            </div>
        </div>
        </div>
        
        <div class="admin-form-group" style="margin-top:0.75rem;">
            <label class="admin-label">Location</label>
            <input type="text" name="location" class="admin-input" placeholder="e.g. DKI Jakarta, Indonesia - Jarak Jauh">
        </div>

        <div class="admin-form-grid" style="margin-top:0.75rem;">
            <div class="admin-form-group">
                <label class="admin-label">Related Project Title</label>
                <input type="text" name="project_title" class="admin-input" placeholder="Project-Based Virtual Intern...">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Related Project URL</label>
                <input type="text" name="project_url" class="admin-input" placeholder="https://example.com/project">
            </div>
        </div>

        <div class="admin-form-grid" style="margin-top:0.75rem;">
            <div class="admin-form-group">
                <label class="admin-label">Logo URL</label>
                <input type="text" name="logo_url" class="admin-input" placeholder="https://example.com/logo.png">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Description <small>(one bullet per line)</small></label>
                <textarea name="description_raw" class="admin-input" rows="4" placeholder="Built end-to-end pipeline..."></textarea>
            </div>
        </div>

        <div class="admin-form-grid" style="margin-top:0.75rem;">
            <div class="admin-form-group">
                <label class="admin-label">Skills <small>(one per line)</small></label>
                <textarea name="skills_raw" class="admin-input" rows="4" placeholder="Problem Solving&#10;Data Cleaning&#10;Data Visualization"></textarea>
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Media / Gallery URLs <small>(one per line)</small></label>
                <textarea name="media_urls_raw" class="admin-input" rows="4" placeholder="https://example.com/img1.png&#10;https://example.com/img2.jpg"></textarea>
            </div>
        </div>
        <div style="display:flex;gap:0.75rem;margin-top:1rem;">
            <button type="submit" class="admin-btn admin-btn--primary admin-btn--sm">Save Entry</button>
            <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="document.getElementById('add-career-form').classList.add('hidden')">Cancel</button>
        </div>
    </form>
</div>

{{-- Career Entries List --}}
@forelse($entries as $entry)
<div class="admin-card" style="margin-bottom:1rem;">
    <div class="admin-card-header">
        <div class="admin-card-title" style="display:flex;align-items:center;gap:0.75rem;">
            @if($entry->logo_url)
            <img src="{{ $entry->logo_url }}" alt="{{ $entry->company }}" style="width:32px;height:32px;object-fit:contain;border-radius:8px;background:rgba(255,255,255,0.05);padding:2px;">
            @endif
            <div>
                <strong>{{ $entry->company }}</strong>
                <div style="font-size:0.8rem;color:var(--text-muted);font-weight:400;">{{ $entry->position }} · <span style="color:var(--accent);">{{ ucfirst($entry->type) }}</span></div>
            </div>
        </div>
        <div style="display:flex;gap:0.5rem;">
            <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="this.closest('.admin-card').querySelector('.career-edit-form').classList.toggle('hidden')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit
            </button>
            <form method="POST" action="{{ route('admin.career.destroy', $entry) }}" onsubmit="return confirm('Delete this career entry?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-btn admin-btn--ghost admin-btn--sm" style="color:#ef4444;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Summary --}}
    <div style="padding:0 1.25rem 1rem;">
        <div style="font-size:0.8rem;color:var(--text-muted);margin-bottom:0.5rem;">
            {{ $entry->duration }}
        </div>
        @if($entry->description)
        <ul style="list-style:none;padding:0;margin:0;">
            @foreach($entry->description as $bullet)
            <li style="font-size:0.8rem;color:var(--text-muted);padding-left:1rem;position:relative;margin-bottom:0.2rem;">
                <span style="position:absolute;left:0;color:var(--accent);">▹</span>
                {{ $bullet }}
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    {{-- Edit Form (hidden) --}}
    <div class="career-edit-form hidden" style="border-top:1px solid var(--border-glass);padding:1.25rem;">
        <form method="POST" action="{{ route('admin.career.update', $entry) }}" class="admin-form">
            @csrf @method('PUT')
            <div class="admin-form-grid">
                <div class="admin-form-group">
                    <label class="admin-label">Company</label>
                    <input type="text" name="company" class="admin-input" value="{{ $entry->company }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Position</label>
                    <input type="text" name="position" class="admin-input" value="{{ $entry->position }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Type</label>
                    <select name="type" class="admin-input" required>
                        <option value="internship" {{ $entry->type === 'internship' ? 'selected' : '' }}>Internship</option>
                        <option value="full-time" {{ $entry->type === 'full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="freelance" {{ $entry->type === 'freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Order</label>
                    <input type="number" name="order" class="admin-input" value="{{ $entry->order }}" min="0">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Start Date</label>
                    <input type="date" name="start_date" class="admin-input" value="{{ $entry->start_date->format('Y-m-d') }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">End Date</label>
                    <input type="date" name="end_date" class="admin-input" value="{{ $entry->end_date?->format('Y-m-d') }}">
                </div>
            </div>
            <div class="admin-form-group" style="margin-top:0.75rem;">
                <label class="admin-label">Location</label>
                <input type="text" name="location" class="admin-input" value="{{ $entry->location }}">
            </div>

            <div class="admin-form-grid" style="margin-top:0.75rem;">
                <div class="admin-form-group">
                    <label class="admin-label">Related Project Title</label>
                    <input type="text" name="project_title" class="admin-input" value="{{ $entry->project_title }}">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Related Project URL</label>
                    <input type="text" name="project_url" class="admin-input" value="{{ $entry->project_url }}">
                </div>
            </div>

            <div class="admin-form-grid" style="margin-top:0.75rem;">
                <div class="admin-form-group">
                    <label class="admin-label">Logo URL</label>
                    <input type="text" name="logo_url" class="admin-input" value="{{ $entry->logo_url }}">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Description (one per line)</label>
                    <textarea name="description_raw" class="admin-input" rows="4">{{ implode("\n", $entry->description ?? []) }}</textarea>
                </div>
            </div>

            <div class="admin-form-grid" style="margin-top:0.75rem;">
                <div class="admin-form-group">
                    <label class="admin-label">Skills (one per line)</label>
                    <textarea name="skills_raw" class="admin-input" rows="4">{{ implode("\n", $entry->skills ?? []) }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Media / Gallery URLs (one per line)</label>
                    <textarea name="media_urls_raw" class="admin-input" rows="4">{{ implode("\n", $entry->media_urls ?? []) }}</textarea>
                </div>
            </div>
            <div style="display:flex;gap:0.75rem;margin-top:1rem;">
                <button type="submit" class="admin-btn admin-btn--primary admin-btn--sm">Update</button>
                <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="this.closest('.career-edit-form').classList.add('hidden')">Cancel</button>
            </div>
        </form>
    </div>
</div>
@empty
<div class="admin-card" style="padding:2rem;text-align:center;color:var(--text-muted);">
    No career entries yet. Click "Add Entry" to create one.
</div>
@endforelse

@endsection
