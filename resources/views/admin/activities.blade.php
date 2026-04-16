@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Activities</h1>
        <p class="admin-page-subtitle">Manage bootcamps, competitions, workshops, and certifications</p>
    </div>
    <button type="button" class="admin-btn admin-btn--primary admin-btn--sm" onclick="document.getElementById('add-activity-form').classList.toggle('hidden')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Activity
    </button>
</div>

{{-- Add Activity Form (hidden by default) --}}
<div id="add-activity-form" class="admin-card hidden" style="margin-bottom:1.5rem;">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Activity
        </div>
    </div>
    <form method="POST" action="{{ route('admin.activities.store') }}" class="admin-form" style="padding:1.25rem;">
        @csrf
        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label class="admin-label">Title</label>
                <input type="text" name="title" class="admin-input" required placeholder="Bangkit Academy 2024">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Category</label>
                <select name="category" class="admin-input" required>
                    <option value="Bootcamp">Bootcamp</option>
                    <option value="Competition">Competition</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Certification">Certification</option>
                    <option value="Article">Article</option>
                </select>
            </div>
        </div>
        <div class="admin-form-group" style="margin-top:0.75rem;">
            <label class="admin-label">Description</label>
            <textarea name="description" class="admin-input" rows="3" required placeholder="Describe the activity..."></textarea>
        </div>
        <div class="admin-form-grid" style="margin-top:0.75rem;">
            <div class="admin-form-group">
                <label class="admin-label">Thumbnail URL</label>
                <input type="text" name="thumbnail_url" class="admin-input" placeholder="https://example.com/thumb.jpg">
            </div>
            <div class="admin-form-group">
                <label class="admin-label">Link URL</label>
                <input type="text" name="link_url" class="admin-input" placeholder="https://example.com">
            </div>
        </div>
        <div class="admin-form-group" style="margin-top:0.75rem;max-width:250px;">
            <label class="admin-label">Published Date</label>
            <input type="date" name="published_at" class="admin-input" required>
        </div>
        <div style="display:flex;gap:0.75rem;margin-top:1rem;">
            <button type="submit" class="admin-btn admin-btn--primary admin-btn--sm">Save Activity</button>
            <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="document.getElementById('add-activity-form').classList.add('hidden')">Cancel</button>
        </div>
    </form>
</div>

{{-- Activities List --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:1rem;">
@forelse($activities as $act)
<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title" style="font-size:0.85rem;">
            <span style="background:rgba(16,185,129,0.12);color:var(--accent);font-size:0.6rem;padding:0.15rem 0.5rem;border-radius:4px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;">{{ $act->category }}</span>
            {{ Str::limit($act->title, 40) }}
        </div>
        <div style="display:flex;gap:0.5rem;">
            <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="this.closest('.admin-card').querySelector('.activity-edit-form').classList.toggle('hidden')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <form method="POST" action="{{ route('admin.activities.destroy', $act) }}" onsubmit="return confirm('Delete this activity?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-btn admin-btn--ghost admin-btn--sm" style="color:#ef4444;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </button>
            </form>
        </div>
    </div>

    <div style="padding:0 1.25rem 1rem;">
        <p style="font-size:0.8rem;color:var(--text-muted);margin-bottom:0.5rem;line-height:1.5;">{{ Str::limit($act->description, 120) }}</p>
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:0.7rem;color:var(--text-muted);font-family:var(--font-heading);">{{ $act->published_at->format('M d, Y') }}</span>
            @if($act->link_url)
            <a href="{{ $act->link_url }}" target="_blank" style="font-size:0.75rem;color:var(--accent);text-decoration:none;">Visit →</a>
            @endif
        </div>
    </div>

    {{-- Edit Form (hidden) --}}
    <div class="activity-edit-form hidden" style="border-top:1px solid var(--border-glass);padding:1.25rem;">
        <form method="POST" action="{{ route('admin.activities.update', $act) }}" class="admin-form">
            @csrf @method('PUT')
            <div class="admin-form-grid">
                <div class="admin-form-group">
                    <label class="admin-label">Title</label>
                    <input type="text" name="title" class="admin-input" value="{{ $act->title }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Category</label>
                    <select name="category" class="admin-input" required>
                        @foreach(['Bootcamp','Competition','Workshop','Certification','Article'] as $cat)
                        <option value="{{ $cat }}" {{ $act->category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="admin-form-group" style="margin-top:0.75rem;">
                <label class="admin-label">Description</label>
                <textarea name="description" class="admin-input" rows="3" required>{{ $act->description }}</textarea>
            </div>
            <div class="admin-form-grid" style="margin-top:0.75rem;">
                <div class="admin-form-group">
                    <label class="admin-label">Thumbnail URL</label>
                    <input type="text" name="thumbnail_url" class="admin-input" value="{{ $act->thumbnail_url }}">
                </div>
                <div class="admin-form-group">
                    <label class="admin-label">Link URL</label>
                    <input type="text" name="link_url" class="admin-input" value="{{ $act->link_url }}">
                </div>
            </div>
            <div class="admin-form-group" style="margin-top:0.75rem;max-width:250px;">
                <label class="admin-label">Published Date</label>
                <input type="date" name="published_at" class="admin-input" value="{{ $act->published_at->format('Y-m-d') }}" required>
            </div>
            <div style="display:flex;gap:0.75rem;margin-top:1rem;">
                <button type="submit" class="admin-btn admin-btn--primary admin-btn--sm">Update</button>
                <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="this.closest('.activity-edit-form').classList.add('hidden')">Cancel</button>
            </div>
        </form>
    </div>
</div>
@empty
<div class="admin-card" style="padding:2rem;text-align:center;color:var(--text-muted);grid-column:1/-1;">
    No activities yet. Click "Add Activity" to create one.
</div>
@endforelse
</div>

@endsection
