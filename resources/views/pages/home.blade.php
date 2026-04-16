@extends('layouts.app')

@section('content')

{{-- ================================== --}}
{{-- GRID HOVER EXPLORE — Framer-style --}}
{{-- ================================== --}}
<section class="grid-hover-section">
    <div class="grid-hover-content">
        <span class="grid-hover-label">// WELCOME</span>
        <h2 class="grid-hover-heading">Explore My <span class="accent">Portfolio</span></h2>
        <p class="grid-hover-sub">Hover over the grid below, then scroll down to discover my work</p>
        <a href="#hero" class="grid-hover-cta">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M19 12l-7 7-7-7"/></svg>
        </a>
    </div>
    <div class="grid-hover-container" id="grid-hover-container">
        {{-- Grid cells created by JS --}}
    </div>
</section>

{{-- ========================= --}}
{{-- SECTION 1: HERO / PROFILE --}}
{{-- ========================= --}}
<section id="hero" class="hero-section">
    {{-- Dark mode dot grid background --}}
    <div class="hero-bg-pattern"></div>

    <div class="hero-container">
        {{-- LEFT: Text Content (both themes share same content) --}}
        <div class="hero-text">
            {{-- Heading --}}
            <h1 class="hero-heading" id="hero-heading">
                <span class="heading-line" data-hero-word>Hi I'M</span>
                <span class="heading-line heading-accent" data-hero-word>Zahran Fikri</span>
            </h1>

            {{-- Typewriter --}}
            <div class="hero-typewriter" id="hero-typewriter">
                <span id="typewriter-text" class="typewriter-text"></span>
                <span class="typewriter-cursor">|</span>
            </div>

            {{-- Bio --}}
            <p class="hero-bio" id="hero-bio">
                A Fresh Graduate from Andalas University with Cum Laude distinction (GPA 3.88), passionate about extracting value from data across its full lifecycle. I have a strong foundation in data concepts, analytical thinking, and problem-solving built through academic projects and internships. I seek career opportunities related to Data and Artificial Intelligence (AI) to leverage my technical skills in solving complex problems and driving informed decision-making.
            </p>

            {{-- CTA Buttons --}}
            <div class="hero-cta" id="hero-cta">
                <a href="#" class="btn-primary" id="cv-download">Download CV</a>
                <a href="#contact" class="btn-secondary">Contact Me</a>
            </div>
        </div>

        {{-- RIGHT: Visual — 3D Tilt Photo Card --}}
        <div class="hero-visual" id="hero-visual">
            <div class="hero-card-3d" id="hero-card-3d" data-tilt-card>
                {{-- Foil / Holographic overlay --}}
                <div class="card-foil-overlay" id="card-foil-overlay"></div>

                {{-- Photo --}}
                <div class="hero-photo-frame">
                    @if($profile->photo_url)
                        <img src="{{ $profile->photo_url }}" alt="{{ $profile->name }}" class="hero-photo" draggable="false">
                    @else
                        <div class="hero-photo-placeholder">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    @endif

                    {{-- Name Badge —  bottom-left shaped label --}}
                    <div class="hero-name-badge" id="hero-name-badge">
                        <div class="name-badge-shape">
                            <div class="name-badge-inner">
                                <span class="badge-name" id="badge-name-text">Zahran Fikri</span>
                                <span class="badge-role">Bachelor of Engineering</span>
                            </div>
                            <div class="badge-shimmer" id="badge-shimmer"></div>
                        </div>
                    </div>
                </div>

                <div class="card-glow-border" id="card-glow-border"></div>
            </div>
        </div>
    </div>

    {{-- Stat Counter Cards --}}
    <div class="stat-cards-section">
        <div class="section-container">
            <div class="stat-cards-row">
                <div class="stat-card">
                    <div class="stat-card-beam"></div>
                    <span class="stat-number" data-target="{{ $portfolioProjects->count() }}" data-suffix="+">0+</span>
                    <span class="stat-label">Projects Completed</span>
                </div>
                <div class="stat-card">
                    <div class="stat-card-beam"></div>
                    <span class="stat-number" data-target="{{ $portfolioCertifications->count() }}" data-suffix="+">0+</span>
                    <span class="stat-label">Certifications</span>
                </div>
                <div class="stat-card">
                    <div class="stat-card-beam"></div>
                    <span class="stat-number" data-target="{{ $activities->count() }}" data-suffix="+">0+</span>
                    <span class="stat-label">Bootcamps Completed</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Skills Marquee --}}
    <div id="skills" class="skills-section">
        @for ($row = 1; $row <= 3; $row++)
            <div class="marquee-row" data-marquee-row data-direction="{{ $row % 2 === 0 ? 'right' : 'left' }}">
                <div class="marquee-track" data-marquee-track>
                    @foreach ($skillRows[$row] ?? [] as $skill)
                        <div class="skill-pill"><i class="{{ $skill->icon_class }}"></i><span>{{ $skill->name }}</span></div>
                    @endforeach
                    @foreach ($skillRows[$row] ?? [] as $skill)
                        <div class="skill-pill"><i class="{{ $skill->icon_class }}"></i><span>{{ $skill->name }}</span></div>
                    @endforeach
                    @foreach ($skillRows[$row] ?? [] as $skill)
                        <div class="skill-pill"><i class="{{ $skill->icon_class }}"></i><span>{{ $skill->name }}</span></div>
                    @endforeach
                </div>
            </div>
        @endfor
    </div>
</section>

{{-- ================================== --}}
{{-- SECTION: ABOUT                    --}}
{{-- ================================== --}}
<section id="about" class="about-section">
    <div class="section-container">
        <div class="section-header" data-scroll-reveal>
            <span class="section-label">// ABOUT</span>
            <h2 class="section-title" data-text-reveal>About <span class="accent" data-hover-highlight>Me</span></h2>
            <p class="section-subtitle">Get to know me better</p>
        </div>
        <div class="about-grid" data-scroll-reveal>
            <div class="about-bio">
                <p class="about-text">
                    A Computer Engineering graduate from Andalas University with a Cum Laude distinction and a GPA of 3.88, driven by a deep curiosity to explore and master emerging technologies. I am passionate about leveraging technical logic to solve complex problems and drive informed decision-making. With a strong foundation in data concepts, analytical thinking, and problem-solving built through academic projects, internships, and self-directed learning, with a keen interest in extracting value from data across the full lifecycle — from data collection and processing to analysis, modeling, and visualization. Actively expanding expertise in modern data technologies, cloud-based solutions, and cybersecurity principles to build a well-rounded and future-ready foundation for a career in the data field.
                </p>
            </div>
            <div class="about-info-card">
                <h3 class="about-info-title">Personal Information</h3>
                <ul class="about-info-list">
                    <li class="about-info-item">
                        <span class="about-info-label">Name</span>
                        <span class="about-info-value">Zahran Fikri</span>
                    </li>
                    <li class="about-info-item">
                        <span class="about-info-label">Location</span>
                        <span class="about-info-value">Padang, Indonesia</span>
                    </li>
                    <li class="about-info-item">
                        <span class="about-info-label">Education</span>
                        <span class="about-info-value">S1 Computer Engineering</span>
                    </li>
                    <li class="about-info-item">
                        <span class="about-info-label">University</span>
                        <span class="about-info-value">Andalas University</span>
                    </li>
                    <li class="about-info-item">
                        <span class="about-info-label">GPA</span>
                        <span class="about-info-value">3.88 / 4.00</span>
                    </li>
                    <li class="about-info-item">
                        <span class="about-info-label">Interest</span>
                        <span class="about-info-value">Data Science & ML</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- =============================== --}}
{{-- SECTION: CAREER JOURNEY (Work Experience) --}}
{{-- =============================== --}}
<section id="career" class="career-section">
    <div class="section-container">
        <div class="section-header" data-scroll-reveal>
            <span class="section-label">// CAREER</span>
            <h2 class="section-title" data-text-reveal>Work <span class="accent" data-hover-highlight>Experience</span></h2>
            <p class="section-subtitle">My professional experience and learning path</p>
        </div>

        <div class="career-list">
            @foreach($careerEntries as $index => $entry)
            <div class="career-card" data-career-card data-entry="{{ json_encode($entry) }}" data-scroll-reveal>
                <div class="career-card-main">
                    <div class="career-card-left">
                        @php
                            // Split duration string to put duration e.g. "(3 Month)" on a new line if needed
                            $durText = $entry->duration;
                            $durParts = explode(' (', $durText);
                            $dateRange = $durParts[0];
                            $months = isset($durParts[1]) ? '(' . $durParts[1] : '';
                        @endphp
                        <span class="career-date-range">{{ $dateRange }}</span>
                        @if($months)
                        <span class="career-date-months">{{ $months }}</span>
                        @endif
                    </div>
                    <div class="career-card-right">
                        <div class="career-card-header">
                            @if($entry->logo_url)
                            <div class="career-company-logo">
                                <img src="{{ $entry->logo_url }}" alt="{{ $entry->company }}">
                            </div>
                            @endif
                            <div class="career-header-info">
                                <h3 class="career-title">{{ $entry->position }}</h3>
                                <p class="career-company">{{ $entry->company }} · {{ ucfirst($entry->type) }}</p>
                                @if($entry->location)
                                <p class="career-location">{{ $entry->location }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="career-card-desc">
                            <p>{{ Str::limit(implode(' ', $entry->description ?? []), 200) }}</p>
                        </div>
                        @php
                            $hasMedia = !empty($entry->media_urls);
                            $mediaList = $hasMedia ? $entry->media_urls : [
                                'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
                                'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop',
                                'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=600&h=400&fit=crop',
                                'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=600&h=400&fit=crop',
                                'https://images.unsplash.com/photo-1611605698335-8b1569810432?w=600&h=400&fit=crop'
                            ]; 
                        @endphp
                        
                        <div class="career-card-gallery">
                            @foreach(array_slice($mediaList, 0, 3) as $index => $media)
                                <div class="career-gallery-item" style="cursor:pointer;" onclick='openLightbox({!! json_encode($mediaList) !!}, {{ $index }}); event.stopPropagation();'>
                                    <img src="{{ $media }}" alt="Activity Photo">
                                </div>
                            @endforeach
                            @if(count($mediaList) > 3)
                                <div class="career-gallery-more" style="cursor:pointer;" onclick='openLightbox({!! json_encode($mediaList) !!}, 3); event.stopPropagation();'>
                                    <img src="{{ $mediaList[3] }}" alt="Activity Photo">
                                    <div class="gallery-more-overlay">
                                        <span>{{ count($mediaList) - 3 }}+</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =============================== -->
<!-- LIGHTBOX MODAL                  -->
<!-- =============================== -->
<div id="image-lightbox" class="lightbox-overlay hidden">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <button class="lightbox-prev" onclick="changeLightboxImage(-1)">&#10094;</button>
    <img id="lightbox-img" src="" alt="Enlarged Photo">
    <button class="lightbox-next" onclick="changeLightboxImage(1)">&#10095;</button>
</div>

{{-- =============================== --}}
{{-- CAREER MODAL                    --}}
{{-- =============================== --}}
<div class="career-modal-overlay" id="career-modal" onclick="if(event.target === this) closeCareerModal()">
    <div class="career-modal-container glass-panel">
        <div class="modal-scroll-container">
            
            <div class="cm-header">
                <div class="cm-header-left">
                    <div class="career-company-logo">
                        <img id="cm-logo" src="" alt="Company Logo" style="display:none;">
                    </div>
                    <div class="cm-titles">
                        <h2 id="cm-position">Position</h2>
                        <p id="cm-company">Company</p>
                        <p id="cm-location">Location</p>
                    </div>
                </div>
                <div class="cm-header-right">
                    <span id="cm-duration">Duration</span>
                    <button class="career-modal-close" onclick="closeCareerModal()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            </div>

            <div class="cm-separator">
                <div class="cm-timeline-line"></div>
                <div class="cm-timeline-dot left"></div>
                <div class="cm-timeline-dot right"></div>
            </div>

            <div id="cm-description" class="modal-desc-body"></div>

            <div id="cm-relevance-container" class="cm-section hidden">
                <h4>Relevance Project</h4>
                <a id="cm-project-link" href="#" target="_blank" class="cm-link">
                    <span id="cm-project-title"></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>

            <div id="cm-skills-container" class="cm-section hidden">
                <h4>Skill</h4>
                <div id="cm-skills-list" class="cm-skills-wrap"></div>
            </div>

            <div id="cm-gallery-container" class="cm-gallery-wrap hidden"></div>
        </div>
    </div>
</div>
    </div>
</section>

{{-- =============================== --}}
{{-- SECTION: EDUCATION & AWARDS     --}}
{{-- =============================== --}}
<section id="education" class="education-section">
    <div class="section-container">
        <div class="section-header" data-scroll-reveal>
            <span class="section-label">// EDUCATION</span>
            <h2 class="section-title" data-text-reveal>Education & <span class="accent" data-hover-highlight>Awards</span></h2>
            <p class="section-subtitle">Academic background and achievements</p>
        </div>
        <div class="edu-grid">
            {{-- Education --}}
            <div class="edu-card" data-scroll-reveal>
                <div class="edu-card-accent edu-card-accent--teal"></div>
                <div class="edu-card-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <h3 class="edu-card-title">Computer Engineering</h3>
                <p class="edu-card-meta">Andalas University | 2020 - 2024</p>
                <p class="edu-card-desc">Graduated with Cum Laude distinction and a GPA of 3.88. Focus on Data Analytics, Machine Learning, and Software Engineering.</p>
            </div>
            {{-- Award --}}
            <div class="edu-card" data-scroll-reveal>
                <div class="edu-card-accent edu-card-accent--blue"></div>
                <div class="edu-card-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                </div>
                <h3 class="edu-card-title">Cum Laude Graduate</h3>
                <p class="edu-card-meta">Andalas University | 2024</p>
                <p class="edu-card-desc">Awarded Cum Laude distinction for outstanding academic performance. Top cohort graduate with excellence in capstone project.</p>
            </div>
        </div>
    </div>
</section>

{{-- =============================== --}}
{{-- SECTION: MY ACTIVITY            --}}
{{-- =============================== --}}
<section id="activity" class="activity-section">
    <div class="section-container">
        {{-- Section heading --}}
        <div class="section-header" data-scroll-reveal>
            <span class="section-label">// ACTIVITY</span>
            <h2 class="section-title">My <span class="accent">Activity</span></h2>
            <p class="section-subtitle">Bootcamps, competitions, and continuous learning</p>
        </div>

        @if($activities->count() > 0)
        {{-- ROW 1: Featured / Latest --}}
        @php $featured = $activities->first(); @endphp
        <div class="activity-featured" data-scroll-reveal>
            <div class="activity-featured-card"
                 data-activity-card 
                 data-full-title="{{ $featured->title }}"
                 data-full-desc="{{ $featured->description }}"
                 data-link="{{ $featured->link_url }}"
                 data-date="{{ $featured->published_at->format('M d, Y') }}"
                 data-category="{{ $featured->category }}"
                 data-thumb="{{ $featured->thumbnail_url }}">
                <div class="activity-featured-badge">
                    <span class="pulse-dot"></span>
                    LATEST
                </div>
                @if($featured->thumbnail_url)
                <div class="activity-featured-thumb">
                    <img src="{{ $featured->thumbnail_url }}" alt="{{ $featured->title }}" draggable="false">
                </div>
                @endif
                <div class="activity-featured-content">
                    <span class="activity-category-pill" data-category="{{ $featured->category }}">{{ $featured->category }}</span>
                    <h3 class="activity-featured-title">{{ $featured->title }}</h3>
                    <p class="activity-featured-desc">{{ $featured->description }}</p>
                    <div class="activity-featured-footer">
                        <span class="activity-date">{{ $featured->published_at->format('M d, Y') }}</span>
                        @if($featured->link_url)
                        <a href="{{ $featured->link_url }}" target="_blank" class="activity-link">
                            Read more
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ROW 2: Horizontal scroll --}}
        @if($activities->count() > 1)
        <div class="activity-scroll-wrapper">
            <div class="activity-scroll-row" id="activity-scroll-row">
                @foreach($activities->skip(1) as $act)
                <div class="activity-card" 
                     data-activity-card 
                     data-full-title="{{ $act->title }}"
                     data-full-desc="{{ $act->description }}"
                     data-link="{{ $act->link_url }}"
                     data-date="{{ $act->published_at->format('M d, Y') }}"
                     data-category="{{ $act->category }}"
                     data-thumb="{{ $act->thumbnail_url }}">
                     
                    @if($act->thumbnail_url)
                    <div class="activity-card-thumb">
                        <img src="{{ $act->thumbnail_url }}" alt="{{ $act->title }}" draggable="false">
                    </div>
                    @else
                    <div class="activity-card-thumb activity-card-thumb--empty">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    @endif
                    <div class="activity-card-body">
                        <span class="activity-category-pill activity-category-pill--sm" data-category="{{ $act->category }}">{{ $act->category }}</span>
                        <h4 class="activity-card-title">{{ $act->title }}</h4>
                        <p class="activity-card-desc">{{ Str::limit($act->description, 100) }}</p>
                        <div class="activity-card-footer">
                            <span class="activity-date">{{ $act->published_at->format('M Y') }}</span>
                            @if($act->link_url)
                            <span class="activity-link">View details</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Activity Detail Modal --}}
        <div class="activity-modal-overlay" id="activity-modal">
            <div class="activity-modal-container">
                <button class="activity-modal-close" id="activity-modal-close">&times;</button>
                <div class="activity-modal-thumb" id="modal-thumb"></div>
                <div class="activity-modal-content">
                    <span class="activity-category-pill" id="modal-category"></span>
                    <h3 class="activity-modal-title" id="modal-title"></h3>
                    <p class="activity-modal-date" id="modal-date"></p>
                    <hr class="activity-modal-divider">
                    <p class="activity-modal-desc" id="modal-desc"></p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- =============================== --}}
{{-- SECTION 5: PORTFOLIO SHOWCASE   --}}
{{-- =============================== --}}
<section id="portfolio" class="portfolio-section">
    <div class="section-container">
        {{-- Section heading --}}
        <div class="section-header" data-scroll-reveal>
            <span class="section-label">// PORTFOLIO</span>
            <h2 class="section-title" data-text-reveal>Selected <span class="accent" data-hover-highlight>Works</span></h2>
            <p class="section-subtitle">Projects & certifications that define my craft</p>
        </div>

        {{-- Tab Switcher --}}
        <div class="portfolio-tabs" data-scroll-reveal>
            <button class="portfolio-tab active" data-tab="projects" id="tab-projects">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                Portfolio
            </button>
            <button class="portfolio-tab" data-tab="certifications" id="tab-certifications">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                Certification
            </button>
            <div class="portfolio-tab-indicator" id="tab-indicator"></div>
        </div>

        {{-- Projects Grid --}}
        <div class="portfolio-grid" id="portfolio-projects-grid">
            @foreach($portfolioProjects as $project)
            <div class="portfolio-card" data-portfolio-card>
                {{-- Frame --}}
                <div class="portfolio-frame">
                    {{-- Image --}}
                    <div class="portfolio-image-wrap">
                        @if($project->thumbnail_url)
                        <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="portfolio-image" loading="lazy">
                        @else
                        <div class="portfolio-image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        @endif
                        {{-- Spotlight overlays --}}
                        <div class="spotlight spotlight-left"></div>
                        <div class="spotlight spotlight-right"></div>
                        {{-- Featured badge --}}
                        @if($project->is_featured)
                        <div class="portfolio-featured-badge">★ FEATURED</div>
                        @endif
                    </div>

                    {{-- Tags --}}
                    @if($project->tags)
                    <div class="portfolio-tags">
                        @foreach(array_slice($project->tags, 0, 4) as $tag)
                        <span class="portfolio-tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Nametag Plate --}}
                    <div class="portfolio-plate">
                        <span class="portfolio-plate-title">{{ $project->title }}</span>
                    </div>
                </div>

                {{-- Bottom: description + links --}}
                <div class="portfolio-card-footer">
                    <p class="portfolio-desc">{{ Str::limit($project->description, 90) }}</p>
                    <div class="portfolio-links">
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="portfolio-link" title="GitHub">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                        </a>
                        @endif
                        @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" class="portfolio-link" title="Live Demo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Certifications Grid --}}
        <div class="portfolio-grid portfolio-grid--hidden" id="portfolio-certs-grid">
            @foreach($portfolioCertifications as $cert)
            <div class="portfolio-card" data-portfolio-card>
                <div class="portfolio-frame">
                    <div class="portfolio-image-wrap">
                        @if($cert->thumbnail_url)
                        <img src="{{ $cert->thumbnail_url }}" alt="{{ $cert->title }}" class="portfolio-image" loading="lazy">
                        @else
                        <div class="portfolio-image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                        </div>
                        @endif
                        <div class="spotlight spotlight-left"></div>
                        <div class="spotlight spotlight-right"></div>
                        @if($cert->is_featured)
                        <div class="portfolio-featured-badge">★ FEATURED</div>
                        @endif
                    </div>

                    @if($cert->tags)
                    <div class="portfolio-tags">
                        @foreach(array_slice($cert->tags, 0, 4) as $tag)
                        <span class="portfolio-tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="portfolio-plate portfolio-plate--cert">
                        <span class="portfolio-plate-title">{{ $cert->title }}</span>
                    </div>
                </div>

                <div class="portfolio-card-footer">
                    <p class="portfolio-desc">
                        <strong>{{ $cert->issuer }}</strong>
                        @if($cert->issued_date) · {{ $cert->issued_date->format('M Y') }} @endif
                    </p>
                    <div class="portfolio-links">
                        @if($cert->cert_url)
                        <a href="{{ $cert->cert_url }}" target="_blank" class="portfolio-link" title="View Certificate">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =============================== --}}
{{-- SECTION 6: GITHUB              --}}
{{-- =============================== --}}
<section id="github" class="github-section section-dark">
    <div class="section-container">
        {{-- Section heading --}}
        <div class="section-header" data-scroll-reveal>
            <span class="section-label section-label--green">// GITHUB</span>
            <h2 class="section-title" data-text-reveal>Open <span class="accent" data-hover-highlight>Source</span></h2>
            <p class="section-subtitle">My contributions and public repositories</p>
        </div>

        @php $githubUsername = $profile->social_links['github'] ?? 'https://github.com/zhraan'; @endphp
        @php $ghUser = basename(rtrim($githubUsername, '/')); @endphp

        {{-- Row 1: Profile Info Card --}}
        <div class="gh-profile-card" data-scroll-reveal>
            <div class="gh-profile-left">
                <img src="https://github.com/{{ $ghUser }}.png?size=120" alt="{{ $ghUser }}" class="gh-avatar-img" id="gh-avatar" onerror="this.style.display='none'">
                <div class="gh-profile-text">
                    <h3 class="gh-profile-name" id="gh-name">{{ $ghUser }}</h3>
                    <p class="gh-profile-bio" id="gh-bio">Data Professional · Open Source Contributor</p>
                    <span class="gh-profile-location" id="gh-location"></span>
                    <a href="{{ $githubUsername }}" target="_blank" class="gh-profile-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795 .945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12Z"/></svg>
                        View Profile →
                    </a>
                </div>
            </div>
            <div class="gh-profile-stats">
                <div class="gh-stat-item">
                    <span class="gh-stat-num" id="gh-repos">0</span>
                    <span class="gh-stat-txt">Repos</span>
                </div>
                <div class="gh-stat-item">
                    <span class="gh-stat-num" id="gh-followers">0</span>
                    <span class="gh-stat-txt">Followers</span>
                </div>
                <div class="gh-stat-item">
                    <span class="gh-stat-num" id="gh-following">0</span>
                    <span class="gh-stat-txt">Following</span>
                </div>
                <div class="gh-stat-item">
                    <span class="gh-stat-num" id="gh-stars">0</span>
                    <span class="gh-stat-txt">Stars</span>
                </div>
            </div>
        </div>

        {{-- Row 2: Latest Repo + Repo List --}}
        <div class="gh-repos-row" data-scroll-reveal>
            <div class="gh-repos-col" id="gh-latest-repo">
                <div class="gh-placeholder-card">
                    <span class="gh-placeholder-text">Loading latest repo...</span>
                </div>
            </div>
            <div class="gh-repos-col gh-repo-list-col" id="gh-repo-list">
                {{-- Repo list items injected by JS --}}
            </div>
        </div>

        {{-- Row 3: Commit Activity Heatmap --}}
        <div class="gh-heatmap-card" data-scroll-reveal>
            <h4 class="gh-heatmap-title">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Commit Activity
            </h4>
            <div class="gh-heatmap-container" id="gh-heatmap">
                {{-- Heatmap SVG rendered by JS --}}
            </div>
        </div>
    </div>
</section>


{{-- =============================== --}}
{{-- SECTION 7: MUSIC               --}}
{{-- =============================== --}}
<section id="music" class="music-section section-dark">
    <div class="section-container">
        <div class="section-header" data-scroll-reveal>
            <span class="section-label section-label--green">// MUSIC</span>
            <h2 class="section-title" data-text-reveal>What I <span class="accent" data-hover-highlight>Listen</span></h2>
            <p class="section-subtitle">The soundtrack to my code sessions</p>
        </div>

        <div class="music-grid-card" data-scroll-reveal>
            @php
            $tracks = [
                ['title' => 'Blinding Lights', 'artist' => 'The Weeknd', 'duration' => '3:20', 'color' => '#e8385d'],
                ['title' => 'Starboy', 'artist' => 'The Weeknd ft. Daft Punk', 'duration' => '3:50', 'color' => '#f5a623'],
                ['title' => 'Levitating', 'artist' => 'Dua Lipa', 'duration' => '3:23', 'color' => '#7b61ff'],
                ['title' => 'Heat Waves', 'artist' => 'Glass Animals', 'duration' => '3:59', 'color' => '#4ecdc4'],
                ['title' => 'Save Your Tears', 'artist' => 'The Weeknd', 'duration' => '3:35', 'color' => '#2196f3'],
                ['title' => 'Peaches', 'artist' => 'Justin Bieber', 'duration' => '3:18', 'color' => '#ff9a76'],
                ['title' => 'As It Was', 'artist' => 'Harry Styles', 'duration' => '2:47', 'color' => '#e91e63'],
                ['title' => 'Stay', 'artist' => 'The Kid LAROI', 'duration' => '2:21', 'color' => '#9c27b0'],
                ['title' => 'Shivers', 'artist' => 'Ed Sheeran', 'duration' => '3:27', 'color' => '#ff5722'],
                ['title' => 'Ghost', 'artist' => 'Justin Bieber', 'duration' => '2:33', 'color' => '#607d8b'],
                ['title' => 'Industry Baby', 'artist' => 'Lil Nas X', 'duration' => '3:32', 'color' => '#ff6f00'],
                ['title' => 'Easy On Me', 'artist' => 'Adele', 'duration' => '3:44', 'color' => '#5c6bc0'],
            ];
            @endphp
            <div class="music-covers-grid">
                @foreach($tracks as $i => $track)
                <div class="music-cover-item" data-music-cover data-track-title="{{ $track['title'] }}" data-track-artist="{{ $track['artist'] }}" data-track-duration="{{ $track['duration'] }}" data-track-color="{{ $track['color'] }}" data-track-index="{{ $i }}">
                    <div class="music-cover-art" style="background: linear-gradient(135deg, {{ $track['color'] }}, {{ $track['color'] }}88);">
                        <span class="music-cover-icon">&#9835;</span>
                        <span class="music-cover-play"><svg width="24" height="24" viewBox="0 0 24 24" fill="#fff"><polygon points="5 3 19 12 5 21 5 3"/></svg></span>
                    </div>
                    <span class="music-cover-title">{{ $track['title'] }}</span>
                    <span class="music-cover-artist">{{ $track['artist'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="music-embed" data-scroll-reveal style="margin-top: 2rem;">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
    </div>
</section>

{{-- Music Player Overlay --}}
<div class="music-player-overlay" id="music-player-overlay">
    <div class="music-player-modal">
        <button class="music-player-close" id="music-player-close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
        <div class="music-player-cover" id="music-player-cover"><span class="music-player-cover-icon">&#9835;</span></div>
        <div class="music-player-info">
            <h3 class="music-player-title" id="music-player-title">Track Title</h3>
            <p class="music-player-artist" id="music-player-artist">Artist</p>
        </div>
        <div class="music-player-progress">
            <div class="music-player-bar"><div class="music-player-bar-fill" id="music-player-bar-fill"></div></div>
            <div class="music-player-times"><span id="music-player-current">0:00</span><span id="music-player-total">0:00</span></div>
        </div>
        <div class="music-player-controls">
            <button class="mp-ctrl"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/><line x1="4" y1="4" x2="9" y2="9"/></svg></button>
            <button class="mp-ctrl"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="19 20 9 12 19 4 19 20"/><line x1="5" y1="19" x2="5" y2="5" stroke="currentColor" stroke-width="2"/></svg></button>
            <button class="mp-ctrl mp-ctrl-play" id="music-player-play"><svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></button>
            <button class="mp-ctrl"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 4 15 12 5 20 5 4"/><line x1="19" y1="5" x2="19" y2="19" stroke="currentColor" stroke-width="2"/></svg></button>
            <button class="mp-ctrl"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg></button>
        </div>
    </div>
</div>

{{-- =============================== --}}
{{-- SECTION 8: CONTACT              --}}
{{-- =============================== --}}
<section id="contact" class="contact-section section-alt">
    <div class="section-container">
        <div class="section-header" data-scroll-reveal>
            <span class="section-label section-label--green">// CONTACT</span>
            <h2 class="section-title" data-text-reveal>Get In <span class="accent" data-hover-highlight>Touch</span></h2>
            <p class="section-subtitle">Have a project in mind? Let's work together</p>
        </div>

        <div class="contact-form-wrapper" data-scroll-reveal>
            <form class="contact-form" id="contact-form">
                <div class="contact-form-row">
                    <div class="contact-field">
                        <label for="contact-name">Name</label>
                        <input type="text" id="contact-name" name="name" placeholder="Your full name" required>
                    </div>
                    <div class="contact-field">
                        <label for="contact-email">Email</label>
                        <input type="email" id="contact-email" name="email" placeholder="your@email.com" required>
                    </div>
                </div>
                <div class="contact-field">
                    <label for="contact-subject">Subject</label>
                    <input type="text" id="contact-subject" name="subject" placeholder="What is this about?">
                </div>
                <div class="contact-field">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" rows="5" placeholder="Tell me about your project..." required></textarea>
                </div>
                <button type="submit" class="contact-submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Send to Email
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="site-footer">
    <div class="footer-container">
        <nav class="footer-nav">
            <a href="#hero">Home</a>
            <a href="#skills">Skills</a>
            <a href="#portfolio">Projects</a>
            <a href="#github">GitHub</a>
            <a href="#music">Music</a>
            <a href="#contact">Contact</a>
        </nav>
        <span class="footer-text">@ 2026 ZhraanF · All Right Reserved</span>
    </div>
</footer>

{{-- Pass data to JS --}}
<script>
    window.__PORTFOLIO_DATA__ = {
        taglines: @json($profile->taglines ?? ['AI Engineer', 'Data Scientist', 'Data Enthusiast']),
        githubUsername: '{{ $ghUser }}',
    };
</script>
@endsection
