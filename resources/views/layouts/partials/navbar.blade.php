{{-- Navigation Header - Dual Theme --}}
<header id="navbar" class="navbar">
    <div class="navbar-container">
        {{-- Logo --}}
        <a href="/" class="navbar-logo" id="nav-logo">
            <span class="logo-dark dark-only">&lt;<span class="logo-accent">Zhraan</span>F&gt;</span>
            <span class="logo-light light-only">&lt;<span class="logo-accent">Zhraan</span>F&gt;</span>
        </a>

        {{-- Nav Links --}}
        <nav class="navbar-links" id="nav-links">
            {{-- Dark mode links --}}
            <div class="nav-items-dark dark-only">
                <a href="#hero" class="nav-link active" data-nav>HOME</a>
                <a href="#about" class="nav-link" data-nav>ABOUT</a>
                <a href="#career" class="nav-link" data-nav>CAREER</a>
                <a href="#portfolio" class="nav-link" data-nav>PROJECTS</a>
                <a href="#github" class="nav-link" data-nav>GITHUB</a>
                <a href="#contact" class="nav-link" data-nav>CONTACT</a>
            </div>
            {{-- Light mode links --}}
            <div class="nav-items-light light-only">
                <a href="#hero" class="nav-link active" data-nav>Home</a>
                <a href="#about" class="nav-link" data-nav>About</a>
                <a href="#career" class="nav-link" data-nav>Career</a>
                <a href="#portfolio" class="nav-link" data-nav>Projects</a>
                <a href="#github" class="nav-link" data-nav>GitHub</a>
                <a href="#contact" class="nav-link" data-nav>Contact</a>
            </div>
        </nav>

        {{-- Right side --}}
        <div class="navbar-actions">
            {{-- Code icon (dark only) --}}
            <button class="nav-icon-btn dark-only" aria-label="Code">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
            </button>


            {{-- Framer-Style Theme Switcher --}}
            <button id="theme-toggle" class="theme-switcher" aria-label="Toggle theme">
                <div class="theme-switcher-knob">
                    <svg class="icon-sun" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                    <svg class="icon-moon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </div>
            </button>

            {{-- Mobile Hamburger --}}
            <button id="mobile-menu-btn" class="mobile-menu-btn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

{{-- Mobile Menu Overlay --}}
<div id="mobile-menu" class="mobile-menu-overlay">
    <nav class="mobile-nav">
        <a href="#hero" class="mobile-nav-link" data-mobile-nav>Home</a>
        <a href="#about" class="mobile-nav-link" data-mobile-nav>About</a>
        <a href="#career" class="mobile-nav-link" data-mobile-nav>Career</a>
        <a href="#portfolio" class="mobile-nav-link" data-mobile-nav>Projects</a>
        <a href="#github" class="mobile-nav-link" data-mobile-nav>GitHub</a>
        <a href="#contact" class="mobile-nav-link" data-mobile-nav>Contact</a>
    </nav>
</div>
