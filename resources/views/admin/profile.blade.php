@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Profile</h1>
        <p class="admin-page-subtitle">Manage your portfolio profile and marquee skills</p>
    </div>
    <a href="/" target="_blank" class="admin-btn admin-btn--ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        View Site
    </a>
</div>

{{-- ── PROFILE CARD ────────────────────────────────────────────── --}}
<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
            Profile
        </div>
        <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" id="btn-toggle-edit" onclick="toggleEditMode()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Edit Profile
        </button>
    </div>

    {{-- ═══ SUMMARY VIEW (read-only, shown by default) ═══ --}}
    <div class="admin-profile-summary" id="profile-summary">
        <div class="summary-header">
            <div class="summary-photo">
                @if($profile->photo_url)
                    <img src="{{ $profile->photo_url }}" alt="{{ $profile->name }}">
                @else
                    <div class="summary-photo-empty">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
                    </div>
                @endif
            </div>
            <div class="summary-info">
                <h2 class="summary-name">{{ $profile->name }}</h2>
                <div class="summary-roles">
                    @foreach($profile->taglines ?? [] as $role)
                        <span class="summary-role-tag">{{ $role }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="summary-bio">
            <label class="admin-label">Bio</label>
            <p>{{ $profile->bio ?? '—' }}</p>
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <label class="admin-label">CV / Resume</label>
                <p>{{ $profile->cv_url && $profile->cv_url !== '#' ? $profile->cv_url : '—' }}</p>
            </div>
            <div class="summary-item">
                <label class="admin-label">Photo URL</label>
                <p>{{ $profile->photo_url ?? '—' }}</p>
            </div>
            <div class="summary-item">
                <label class="admin-label">GitHub</label>
                <p>{{ $profile->social_links['github'] ?? '—' }}</p>
            </div>
            <div class="summary-item">
                <label class="admin-label">LinkedIn</label>
                <p>{{ $profile->social_links['linkedin'] ?? '—' }}</p>
            </div>
            <div class="summary-item">
                <label class="admin-label">Twitter / X</label>
                <p>{{ $profile->social_links['twitter'] ?? '—' }}</p>
            </div>
        </div>
    </div>

    {{-- ═══ EDIT VIEW (hidden by default) ═══ --}}
    <div class="admin-profile-edit" id="profile-edit" style="display:none;">
        <form method="POST" action="{{ route('admin.profile.update') }}" class="admin-form" enctype="multipart/form-data">
            @csrf
            <div class="admin-form-grid">
                {{-- Display Name --}}
                <div class="admin-field">
                    <label class="admin-label">Display Name</label>
                    <input type="text" name="name" class="admin-input" value="{{ old('name', $profile->name) }}" required placeholder="e.g. Zahran Fikri">
                    @error('name')<span class="admin-error">{{ $message }}</span>@enderror
                </div>

                {{-- Profile Photo with preview + file browse --}}
                <div class="admin-field">
                    <label class="admin-label">Profile Photo</label>
                    <div class="admin-photo-upload-v2">
                        <div class="admin-photo-preview-lg" id="photo-preview">
                            @if($profile->photo_url)
                                <img src="{{ $profile->photo_url }}" alt="Preview" id="photo-preview-img">
                            @else
                                <div class="admin-photo-empty-lg">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                                    <span>No photo</span>
                                </div>
                            @endif
                        </div>
                        <div class="admin-photo-controls-v2">
                            <input type="text" name="photo_url" class="admin-input admin-input--sm" value="{{ old('photo_url', $profile->photo_url) }}" placeholder="/img/photo.jpeg" id="photo-url-input">
                            <div class="admin-photo-browse-row">
                                <label class="admin-btn admin-btn--sm admin-btn--ghost admin-browse-btn">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                    Browse File
                                    <input type="file" accept="image/*" id="photo-file-input" style="display:none;">
                                </label>
                                <span class="admin-label-hint">or enter URL path above</span>
                            </div>
                        </div>
                    </div>
                    @error('photo_url')<span class="admin-error">{{ $message }}</span>@enderror
                </div>

                {{-- Bio --}}
                <div class="admin-field admin-field--full">
                    <label class="admin-label">Bio <span class="admin-label-hint">(max 1000 chars)</span></label>
                    <textarea name="bio" class="admin-input admin-textarea" rows="3" placeholder="Describe yourself...">{{ old('bio', $profile->bio) }}</textarea>
                    @error('bio')<span class="admin-error">{{ $message }}</span>@enderror
                </div>

                {{-- Taglines --}}
                <div class="admin-field admin-field--full">
                    <label class="admin-label">Typewriter Roles <span class="admin-label-hint">(one per line)</span></label>
                    <textarea name="taglines_raw" class="admin-input admin-textarea admin-textarea--code" rows="4" placeholder="Data Scientist&#10;ML Engineer">{{ old('taglines_raw', implode("\n", $profile->taglines ?? [])) }}</textarea>
                    @error('taglines_raw')<span class="admin-error">{{ $message }}</span>@enderror
                </div>

                {{-- CV URL --}}
                <div class="admin-field admin-field--full">
                    <label class="admin-label">CV / Resume URL</label>
                    <input type="text" name="cv_url" class="admin-input" value="{{ old('cv_url', $profile->cv_url) }}" placeholder="https://drive.google.com/...">
                    @error('cv_url')<span class="admin-error">{{ $message }}</span>@enderror
                </div>

                {{-- Social Links --}}
                <div class="admin-field">
                    <label class="admin-label">GitHub URL</label>
                    <input type="url" name="social_github" class="admin-input" value="{{ old('social_github', $profile->social_links['github'] ?? '') }}" placeholder="https://github.com/...">
                </div>
                <div class="admin-field">
                    <label class="admin-label">LinkedIn URL</label>
                    <input type="url" name="social_linkedin" class="admin-input" value="{{ old('social_linkedin', $profile->social_links['linkedin'] ?? '') }}" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="admin-field admin-field--full">
                    <label class="admin-label">Twitter / X URL</label>
                    <input type="url" name="social_twitter" class="admin-input" value="{{ old('social_twitter', $profile->social_links['twitter'] ?? '') }}" placeholder="https://twitter.com/...">
                </div>
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Profile
                </button>
                <button type="button" class="admin-btn admin-btn--ghost" onclick="toggleEditMode()">Cancel</button>
            </div>
        </form>
    </div>
</div>

{{-- ── MARQUEE SKILLS ───────────────────────────────────────────── --}}
<div class="admin-card" style="margin-top: 2rem;">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
            Marquee Skills
        </div>
        <span class="admin-badge-count">{{ $skills->flatten()->count() }} skills</span>
    </div>

    @foreach([1 => 'Row 1', 2 => 'Row 2', 3 => 'Row 3'] as $rowNum => $rowLabel)
    <div class="admin-skills-group">
        <h3 class="admin-skills-group-title">{{ $rowLabel }}</h3>

        {{-- Selected skills as tags --}}
        <div class="skill-tags-container" id="skill-tags-row-{{ $rowNum }}">
            @foreach($skills[$rowNum] ?? [] as $skill)
            <div class="skill-tag" id="skill-node-{{ $skill->id }}" onclick="deleteSkillAjax(this, {{ $skill->id }}, '{{ addslashes($skill->name) }}')" title="Click to remove {{ $skill->name }}">
                <i class="{{ $skill->icon_class }}" style="font-size:14px;"></i>
                <span>{{ $skill->name }}</span>
            </div>
            @endforeach
        </div>

        {{-- Search dropdown & Staging Area --}}
        <div class="skill-dropdown-wrapper" id="skill-dropdown-row-{{ $rowNum }}">
            {{-- Staged skills appear here temporarily before save --}}
            <div class="skill-staged-area" id="skill-staged-{{ $rowNum }}" style="display:none; margin-bottom: 0.75rem; gap: 0.5rem; flex-wrap: wrap;"></div>
            
            <div class="skill-search-input-wrap">
                <input type="text" class="admin-input skill-search-input" placeholder="Search and select multiple skills..." autocomplete="off"
                       data-row="{{ $rowNum }}" id="skill-search-{{ $rowNum }}">
                <svg class="skill-search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <div class="skill-dropdown-options" id="skill-options-{{ $rowNum }}" style="display:none;"></div>
            
            {{-- Save actions for multi-select --}}
            <div style="margin-top:0.75rem; display:none; gap: 0.5rem;" id="skill-save-wrapper-{{ $rowNum }}">
                <button type="button" class="admin-btn admin-btn--primary admin-btn--sm" onclick="saveStagedSkills({{ $rowNum }})" id="btn-save-staged-{{ $rowNum }}">
                    Save Selected Skills
                </button>
                <button type="button" class="admin-btn admin-btn--ghost admin-btn--sm" onclick="clearStagedSkills({{ $rowNum }})">Clear</button>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- ── Custom Delete Confirmation Modal ── --}}
<div id="delete-skill-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center; backdrop-filter:blur(4px);">
    <div style="background:var(--bg-card); padding:2rem; border-radius:12px; border:1px solid var(--border-glass); max-width:400px; width:90%; box-shadow:0 10px 25px rgba(0,0,0,0.5);">
        <h3 style="margin-top:0; font-family:'Share Tech Mono', monospace; font-size:1.2rem; color: #ef4444; display:flex; align-items:center; gap:0.5rem;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            Remove Skill
        </h3>
        <p style="color:var(--text-muted); margin-bottom:1.5rem;" id="delete-modal-text">Are you sure you want to remove this skill?</p>
        <div style="display:flex; justify-content:flex-end; gap:0.8rem;">
            <button type="button" class="admin-btn admin-btn--ghost" onclick="closeDeleteModal()">Cancel</button>
            <button type="button" class="admin-btn admin-btn--primary" style="background:#ef4444; border-color:#ef4444;" id="delete-modal-confirm">Delete</button>
        </div>
    </div>
</div>

<script>
// ─── Toggle Summary / Edit ───────────────────────────────────────────
function toggleEditMode() {
    const summary = document.getElementById('profile-summary');
    const edit = document.getElementById('profile-edit');
    const btn = document.getElementById('btn-toggle-edit');

    if (edit.style.display === 'none') {
        summary.style.display = 'none';
        edit.style.display = 'block';
        btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Cancel`;
    } else {
        summary.style.display = 'block';
        edit.style.display = 'none';
        btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit Profile`;
    }
}


// ─── Skill Dropdown Data ─────────────────────────────────────────────
const DEVICON_SKILLS = [
    { name: "Python", icon: "devicon-python-plain colored", category: "Language" },
    { name: "R", icon: "devicon-r-plain colored", category: "Language" },
    { name: "SQL", icon: "devicon-azuresqldatabase-plain colored", category: "Language" },
    { name: "Julia", icon: "devicon-julia-plain colored", category: "Language" },
    { name: "Java", icon: "devicon-java-plain colored", category: "Language" },
    { name: "Scala", icon: "devicon-scala-plain colored", category: "Language" },
    { name: "JavaScript", icon: "devicon-javascript-plain colored", category: "Language" },
    { name: "TypeScript", icon: "devicon-typescript-plain colored", category: "Language" },
    { name: "Go", icon: "devicon-go-original-wordmark colored", category: "Language" },
    { name: "Rust", icon: "devicon-rust-original", category: "Language" },
    { name: "C++", icon: "devicon-cplusplus-plain colored", category: "Language" },
    { name: "C#", icon: "devicon-csharp-plain colored", category: "Language" },
    { name: "Pandas", icon: "devicon-pandas-plain colored", category: "Data Science" },
    { name: "NumPy", icon: "devicon-numpy-plain colored", category: "Data Science" },
    { name: "Matplotlib", icon: "devicon-matplotlib-plain colored", category: "Data Science" },
    { name: "Plotly", icon: "devicon-plotly-plain colored", category: "Data Science" },
    { name: "Seaborn", icon: "devicon-python-plain colored", category: "Data Science" },
    { name: "Jupyter", icon: "devicon-jupyter-plain colored", category: "Data Science" },
    { name: "Anaconda", icon: "devicon-anaconda-original colored", category: "Data Science" },
    { name: "TensorFlow", icon: "devicon-tensorflow-original colored", category: "AI/ML" },
    { name: "PyTorch", icon: "devicon-pytorch-original colored", category: "AI/ML" },
    { name: "Keras", icon: "devicon-keras-plain colored", category: "AI/ML" },
    { name: "Scikit-learn", icon: "devicon-scikitlearn-plain colored", category: "AI/ML" },
    { name: "OpenCV", icon: "devicon-opencv-plain colored", category: "AI/ML" },
    { name: "HuggingFace", icon: "devicon-python-plain colored", category: "AI/ML" },
    { name: "LangChain", icon: "devicon-python-plain colored", category: "AI/ML" },
    { name: "Apache Spark", icon: "devicon-apachespark-original colored", category: "Data Engineering" },
    { name: "Apache Kafka", icon: "devicon-apachekafka-original colored", category: "Data Engineering" },
    { name: "Apache Airflow", icon: "devicon-apacheairflow-plain colored", category: "Data Engineering" },
    { name: "Hadoop", icon: "devicon-hadoop-plain colored", category: "Data Engineering" },
    { name: "Docker", icon: "devicon-docker-plain colored", category: "Data Engineering" },
    { name: "Kubernetes", icon: "devicon-kubernetes-plain colored", category: "Data Engineering" },
    { name: "PostgreSQL", icon: "devicon-postgresql-plain colored", category: "Database" },
    { name: "MySQL", icon: "devicon-mysql-plain colored", category: "Database" },
    { name: "MongoDB", icon: "devicon-mongodb-plain colored", category: "Database" },
    { name: "Redis", icon: "devicon-redis-plain colored", category: "Database" },
    { name: "SQLite", icon: "devicon-sqlite-plain colored", category: "Database" },
    { name: "Power BI", icon: "devicon-azure-plain colored", category: "BI" },
    { name: "Tableau", icon: "devicon-python-plain colored", category: "BI" },
    { name: "Looker", icon: "devicon-google-plain colored", category: "BI" },
    { name: "Excel", icon: "devicon-python-plain colored", category: "BI" },
    { name: "dbt", icon: "devicon-python-plain colored", category: "Data Engineering" },
    { name: "BigQuery", icon: "devicon-googlecloud-plain colored", category: "Database" },
    { name: "AWS", icon: "devicon-amazonwebservices-plain-wordmark colored", category: "Cloud" },
    { name: "Google Cloud", icon: "devicon-googlecloud-plain colored", category: "Cloud" },
    { name: "Azure", icon: "devicon-azure-plain colored", category: "Cloud" },
    { name: "Git", icon: "devicon-git-plain colored", category: "Tool" },
    { name: "Linux", icon: "devicon-linux-plain colored", category: "Tool" },
    { name: "VSCode", icon: "devicon-vscode-plain colored", category: "Tool" },
    { name: "Grafana", icon: "devicon-grafana-plain colored", category: "Tool" },
    { name: "Prometheus", icon: "devicon-prometheus-original colored", category: "Tool" },
    { name: "React", icon: "devicon-react-original colored", category: "Web" },
    { name: "Next.js", icon: "devicon-nextjs-original-wordmark", category: "Web" },
    { name: "Node.js", icon: "devicon-nodejs-plain colored", category: "Web" },
    { name: "Laravel", icon: "devicon-laravel-original colored", category: "Web" },
    { name: "FastAPI", icon: "devicon-fastapi-plain colored", category: "Web" },
    { name: "Flask", icon: "devicon-flask-original colored", category: "Web" },
    { name: "Django", icon: "devicon-django-plain colored", category: "Web" },
    { name: "Streamlit", icon: "devicon-streamlit-plain colored", category: "Web" },
    { name: "Microsoft Fabric", icon: "devicon-azure-plain colored", category: "Data Engineering" },
];

const EXISTING_SKILLS = {
    @foreach([1,2,3] as $r)
    {{ $r }}: [
        @foreach($skills[$r] ?? [] as $s)
        "{{ $s->name }}",
        @endforeach
    ],
    @endforeach
};

// ─── Init ────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    [1, 2, 3].forEach(initSkillDropdown);
    initPhotoPreview();
});

let stagedSkills = { 1: [], 2: [], 3: [] };

function initSkillDropdown(row) {
    const input = document.getElementById('skill-search-' + row);
    const optionsDiv = document.getElementById('skill-options-' + row);
    if (!input || !optionsDiv) return;

    let isOpen = false;

    function renderOptions(filter = '') {
        const existingNames = EXISTING_SKILLS[row] || [];
        const stagedNames = stagedSkills[row].map(s => s.name);
        
        const lower = filter.toLowerCase();
        let filtered = DEVICON_SKILLS.filter(s =>
            !existingNames.includes(s.name) &&
            !stagedNames.includes(s.name) &&
            (s.name.toLowerCase().includes(lower) || s.category.toLowerCase().includes(lower))
        );

        let html = '';
        filtered.slice(0, 20).forEach(s => {
            html += `<div class="skill-option" data-name="${s.name}" data-icon="${s.icon}" data-category="${s.category}"
                     onclick="stageSkill(${row}, '${s.name}', '${s.icon}', '${s.category}')">
                <i class="${s.icon}" style="font-size:16px;"></i>
                <span class="skill-option-name">${s.name}</span>
                <span class="skill-option-cat">${s.category}</span>
            </div>`;
        });

        if (filter.trim() && !DEVICON_SKILLS.some(s => s.name.toLowerCase() === lower)) {
            html += `<div class="skill-option skill-option--create" data-name="${filter.trim()}" data-icon="devicon-devicon-plain colored" data-category="Custom"
                     onclick="stageSkill(${row}, '${filter.trim()}', 'devicon-devicon-plain colored', 'Custom')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>Create "<strong>${filter.trim()}</strong>"</span>
            </div>`;
        }

        if (!html) html = '<div class="skill-option skill-option--empty">No available skills match</div>';

        optionsDiv.innerHTML = html;
    }

    input.addEventListener('focus', () => {
        renderOptions(input.value);
        optionsDiv.style.display = 'block';
        isOpen = true;
    });

    input.addEventListener('input', () => {
        renderOptions(input.value);
        if (!isOpen) { optionsDiv.style.display = 'block'; isOpen = true; }
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('#skill-dropdown-row-' + row)) {
            optionsDiv.style.display = 'none';
            isOpen = false;
        }
    });

    window['renderOptionsRow' + row] = renderOptions; // Expose for re-rendering
}

function stageSkill(row, name, icon, category) {
    if (stagedSkills[row].some(s => s.name === name)) return;
    stagedSkills[row].push({ name, icon_class: icon, category, row_number: row, order: 0 });
    
    const input = document.getElementById('skill-search-' + row);
    input.value = '';
    input.focus();
    
    window['renderOptionsRow' + row]();
    renderStagedArea(row);
}

function unstageSkill(row, name) {
    stagedSkills[row] = stagedSkills[row].filter(s => s.name !== name);
    renderStagedArea(row);
    window['renderOptionsRow' + row]();
}

function clearStagedSkills(row) {
    stagedSkills[row] = [];
    renderStagedArea(row);
    document.getElementById('skill-search-' + row).value = '';
    window['renderOptionsRow' + row]();
}

function renderStagedArea(row) {
    const area = document.getElementById('skill-staged-' + row);
    const saveWrap = document.getElementById('skill-save-wrapper-' + row);
    
    if (stagedSkills[row].length === 0) {
        area.style.display = 'none';
        saveWrap.style.display = 'none';
        return;
    }
    
    let html = '';
    stagedSkills[row].forEach(s => {
        html += `<div class="skill-staged-tag">
            <i class="${s.icon_class}" style="font-size:14px;"></i><span>${s.name}</span>
            <button type="button" onclick="unstageSkill(${row}, '${s.name}')" title="Unstage ${s.name}">×</button>
        </div>`;
    });
    
    area.innerHTML = html;
    area.style.display = 'flex';
    
    saveWrap.style.display = 'flex';
    document.getElementById('btn-save-staged-' + row).innerText = `Save ${stagedSkills[row].length} Skill${stagedSkills[row].length > 1 ? 's' : ''}`;
}

function saveStagedSkills(row) {
    if (stagedSkills[row].length === 0) return;
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const saveBtn = document.getElementById('btn-save-staged-' + row);
    saveBtn.innerText = 'Saving...';
    saveBtn.disabled = true;

    fetch('{{ route("admin.skills.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ skills: stagedSkills[row] })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const container = document.getElementById('skill-tags-row-' + row);
            data.skills.forEach(skill => {
                const div = document.createElement('div');
                div.className = 'skill-tag';
                div.id = 'skill-node-' + skill.id;
                div.title = 'Click to remove ' + skill.name;
                div.onclick = function() { deleteSkillAjax(this, skill.id, skill.name); };
                div.innerHTML = `<i class="${skill.icon_class}" style="font-size:14px;"></i>
                    <span>${skill.name}</span>`;
                container.appendChild(div);
                
                if (!EXISTING_SKILLS[row]) EXISTING_SKILLS[row] = [];
                EXISTING_SKILLS[row].push(skill.name);
            });
            
            clearStagedSkills(row);
            saveBtn.disabled = false;
        }
    })
    .catch(err => {
        console.error(err);
        saveBtn.disabled = false;
        alert('Failed to save skills');
    });
}

let currentDeleteTask = null;

function deleteSkillAjax(btnElement, id, name) {
    document.getElementById('delete-modal-text').innerHTML = `Are you sure you want to remove "<strong>${name}</strong>"?`;
    document.getElementById('delete-skill-modal').style.display = 'flex';
    
    currentDeleteTask = function() {
        closeDeleteModal();
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        btnElement.style.opacity = '0.5';
        btnElement.style.pointerEvents = 'none';
        
        fetch('/admin/skills/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const node = document.getElementById('skill-node-' + id);
                if (node) {
                    const row = node.parentElement.id.replace('skill-tags-row-', '');
                    if (EXISTING_SKILLS[row]) {
                        EXISTING_SKILLS[row] = EXISTING_SKILLS[row].filter(n => n !== name);
                    }
                    
                    node.style.opacity = '0';
                    node.style.transform = 'scale(0.9)';
                    node.style.transition = 'all 0.2s';
                    setTimeout(() => node.remove(), 200);
                    
                    // update badges
                    const badge = document.querySelector('.admin-badge-count');
                    if (badge) {
                         let c = parseInt(badge.innerText);
                         badge.innerText = (c - 1) + ' skills';
                    }
                }
            }
        })
        .catch(err => {
            console.error("Failed to delete", err);
            btnElement.style.opacity = '1';
            btnElement.style.pointerEvents = 'auto';
        });
    };
}

function closeDeleteModal() {
    document.getElementById('delete-skill-modal').style.display = 'none';
    currentDeleteTask = null;
}

document.getElementById('delete-modal-confirm').addEventListener('click', () => {
    if (currentDeleteTask) currentDeleteTask();
});

// ─── Photo Preview + File Browse ─────────────────────────────────────
function initPhotoPreview() {
    const urlInput = document.getElementById('photo-url-input');
    const fileInput = document.getElementById('photo-file-input');
    const preview = document.getElementById('photo-preview');
    if (!urlInput || !preview) return;

    // Live preview from URL
    urlInput.addEventListener('input', () => {
        const url = urlInput.value.trim();
        if (url) {
            preview.innerHTML = `<img src="${url}" alt="Preview" id="photo-preview-img" onerror="this.style.display='none'">`;
        } else {
            showEmptyPreview(preview);
        }
    });

    // Browse local file
    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            // Show preview immediately via FileReader
            const reader = new FileReader();
            reader.onload = (ev) => {
                preview.innerHTML = `<img src="${ev.target.result}" alt="Preview" id="photo-preview-img">`;
            };
            reader.readAsDataURL(file);

            // Upload file via AJAX to store in public/img/
            const formData = new FormData();
            formData.append('photo', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("admin.profile.upload-photo") }}', {
                method: 'POST',
                body: formData,
            })
            .then(r => r.json())
            .then(data => {
                if (data.url) {
                    urlInput.value = data.url;
                }
            })
            .catch(err => console.error('Upload failed:', err));
        });
    }
}

function showEmptyPreview(container) {
    container.innerHTML = '<div class="admin-photo-empty-lg"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg><span>No photo</span></div>';
}
</script>

@endsection
