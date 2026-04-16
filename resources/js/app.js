/**
 * Main App — Initialize all animations and interactions
 * Includes: Preloader, Cursor Trail, GSAP ScrollTrigger, Framer-style transitions
 */
import { initTheme } from './theme.js';
import { initMarquee } from './marquee.js';

document.addEventListener('DOMContentLoaded', () => {
    // Wait for GSAP to be available (loaded from CDN)
    waitForGSAP(() => {
        gsap.registerPlugin(ScrollTrigger, TextPlugin);

        initTheme();
        initPreloader(() => {
            initNavbar();
            initColumnTransition();
            initGridHover();
            initHeroAnimations();
            initMobileMenu();
            initCustomCursor();
            initScrollReveal();
            initTextReveal();
            initHoverHighlight();
            initStatCounters();
            initPixelScroll();
            initCareerAnimations();
            initActivityAnimations();
            initActivityInteraction();
            initCareerInteraction();
            initPortfolio();
            initGitHub();
            initMusicSection();
            initContactForm();

            requestAnimationFrame(() => {
                initMarquee();
            });
        });
    });
});

/**
 * Wait for GSAP to load from CDN
 */
function waitForGSAP(callback, attempts = 0) {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' && typeof TextPlugin !== 'undefined') {
        callback();
    } else if (attempts < 50) {
        setTimeout(() => waitForGSAP(callback, attempts + 1), 100);
    }
}

/* ============================================
   PRELOADER — Loading Bar Animation
   ============================================ */
function initPreloader(onComplete) {
    const preloader = document.getElementById('preloader');
    const bar = document.getElementById('preloader-bar');
    const percent = document.getElementById('preloader-percent');

    if (!preloader) { onComplete(); return; }

    // Random pause points to simulate real loading
    const pausePoints = [22, 45, 68, 85, 95];
    const pauseDurations = [0.3, 0.4, 0.3, 0.5, 0.2];

    const tl = gsap.timeline({
        onComplete: () => {
            gsap.to(preloader, {
                yPercent: -100,
                duration: 0.8,
                ease: 'power4.inOut',
                onComplete: () => {
                    preloader.style.display = 'none';
                    onComplete();
                }
            });
        }
    });

    // Build segments with random pauses
    let segments = [];
    let prev = 0;
    pausePoints.forEach((point, i) => {
        segments.push({ from: prev, to: point, pause: pauseDurations[i] });
        prev = point;
    });
    segments.push({ from: prev, to: 100, pause: 0 });

    let runningTime = 0;
    segments.forEach(seg => {
        const range = seg.to - seg.from;
        const dur = range * 0.02; // ~2s total
        const countObj = { val: seg.from };
        tl.to(countObj, {
            val: seg.to,
            duration: dur,
            ease: 'power1.inOut',
            onUpdate: () => {
                const v = Math.floor(countObj.val);
                percent.textContent = v + '%';
                bar.style.width = v + '%';
            }
        }, runningTime);
        runningTime += dur + seg.pause;
    });

    // Brief hold at 100%
    tl.to({}, { duration: 0.3 });
}

/* ============================================
   COLUMN TRANSITION — Cinematic section wipe
   ============================================ */
function initColumnTransition() {
    // Create column overlay container
    const overlay = document.createElement('div');
    overlay.className = 'column-transition-overlay';
    overlay.id = 'column-transition';
    for (let i = 0; i < 5; i++) {
        const col = document.createElement('div');
        col.className = 'column-transition-col';
        overlay.appendChild(col);
    }
    document.body.appendChild(overlay);

    // Intercept nav link clicks
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        const targetId = link.getAttribute('href');
        if (!targetId || targetId === '#') return;
        
        // Skip column transition for in-page CTA buttons (use native smooth scroll)
        if (link.classList.contains('grid-hover-cta') || 
            link.classList.contains('btn-primary') || 
            link.classList.contains('btn-secondary')) return;

        const target = document.querySelector(targetId);
        if (!target) return;

        link.addEventListener('click', (e) => {
            e.preventDefault();
            const cols = overlay.querySelectorAll('.column-transition-col');
            const tl = gsap.timeline();

            // Columns sweep IN (cover screen)
            tl.fromTo(cols, 
                { scaleY: 0 },
                { scaleY: 1, duration: 0.4, stagger: 0.06, ease: 'power3.inOut', transformOrigin: 'top' }
            );

            // Scroll while covered
            tl.add(() => {
                window.scrollTo({ top: target.offsetTop - 80, behavior: 'instant' });
            });

            // Columns sweep OUT (reveal)
            tl.to(cols, {
                scaleY: 0,
                duration: 0.4,
                stagger: 0.06,
                ease: 'power3.inOut',
                transformOrigin: 'bottom',
                delay: 0.1
            });
        });
    });
}

/* ============================================
   CUSTOM CURSOR TRAIL — Single color, clear
   ============================================ */
function initCustomCursor() {
    const dot = document.getElementById('cursor-dot');
    const ring = document.getElementById('cursor-ring');

    if (!dot || !ring || window.matchMedia('(hover: none)').matches) return;

    document.body.style.cursor = 'none';

    // Faster follow — less delay on ring
    const xDot = gsap.quickTo(dot, 'x', { duration: 0.1, ease: 'power3.out' });
    const yDot = gsap.quickTo(dot, 'y', { duration: 0.1, ease: 'power3.out' });
    const xRing = gsap.quickTo(ring, 'x', { duration: 0.2, ease: 'power3.out' });
    const yRing = gsap.quickTo(ring, 'y', { duration: 0.2, ease: 'power3.out' });

    window.addEventListener('pointermove', (e) => {
        xDot(e.clientX - 4);
        yDot(e.clientY - 4);
        xRing(e.clientX - 18);
        yRing(e.clientY - 18);
    });

    // Enlarge on interactive elements
    document.querySelectorAll('a, button, [data-tilt-card], .skill-pill, .activity-card, .career-card, .portfolio-card, .stat-card').forEach(el => {
        el.style.cursor = 'none';
        el.addEventListener('mouseenter', () => {
            gsap.to(dot, { scale: 2.5, duration: 0.25, ease: 'power3.out' });
            gsap.to(ring, { scale: 1.5, opacity: 0.4, duration: 0.25, ease: 'power3.out' });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(dot, { scale: 1, duration: 0.25, ease: 'power3.out' });
            gsap.to(ring, { scale: 1, opacity: 0.8, duration: 0.25, ease: 'power3.out' });
        });
    });
}

/* ============================================
   SCROLL REVEAL — Framer-style fade + translate
   ============================================ */
function initScrollReveal() {
    gsap.utils.toArray('[data-scroll-reveal]').forEach(el => {
        gsap.to(el, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            }
        });
    });
}

/* ============================================
   TEXT REVEAL — Scroll-triggered word reveal
   ============================================ */
function initTextReveal() {
    document.querySelectorAll('[data-text-reveal]').forEach(el => {
        const text = el.textContent;
        const words = text.split(' ');
        el.innerHTML = words.map(w => `<span class="reveal-word"><span class="reveal-word-inner">${w}</span></span>`).join(' ');

        gsap.fromTo(el.querySelectorAll('.reveal-word-inner'),
            { y: '100%', opacity: 0 },
            {
                y: '0%',
                opacity: 1,
                duration: 0.6,
                stagger: 0.05,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse',
                }
            }
        );
    });
}

/* ============================================
   HOVER TEXT HIGHLIGHT — Accent wipe on hover
   ============================================ */
function initHoverHighlight() {
    document.querySelectorAll('[data-hover-highlight]').forEach(el => {
        el.classList.add('hover-highlight-text');
    });
}

/* ============================================
   GRID HOVER EFFECT — Framer-style interactive grid
   ============================================ */
function initGridHover() {
    const grid = document.getElementById('grid-hover-container');
    if (!grid) return;

    const cellSize = 60; // uniform square cells
    const section = grid.closest('.grid-hover-section');

    function buildGrid() {
        grid.innerHTML = '';
        const w = section.offsetWidth;
        const h = section.offsetHeight;
        const cols = Math.ceil(w / (cellSize + 1));
        const rows = Math.ceil(h / (cellSize + 1));
        const totalCells = cols * rows;

        for (let i = 0; i < totalCells; i++) {
            const cell = document.createElement('div');
            cell.className = 'grid-cell';
            grid.appendChild(cell);
        }
    }

    buildGrid();
    window.addEventListener('resize', buildGrid);

    // Scroll entrance
    gsap.fromTo(grid,
        { opacity: 0 },
        {
            opacity: 1,
            duration: 1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 90%',
                toggleActions: 'play none none reverse',
            }
        }
    );
}

/* ============================================
   PIXEL SCROLL TRANSITION — Mosaic dissolve
   ============================================ */
function initPixelScroll() {
    const pixelSections = document.querySelectorAll('[data-pixel-transition]');
    if (!pixelSections.length) return;

    pixelSections.forEach(section => {
        const canvas = document.createElement('canvas');
        canvas.className = 'pixel-scroll-canvas';
        section.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const pixelSize = 20;
        let cols, rows;
        let progress = 0;

        const isDark = () => document.documentElement.getAttribute('data-theme') === 'dark';
        const bgColor = () => isDark() ? '#0A0A0A' : '#FFFFFF';
        const fgColor = () => section.dataset.pixelColor || (isDark() ? '#00FF85' : '#10B981');

        function resize() {
            canvas.width = section.offsetWidth;
            canvas.height = section.offsetHeight;
            cols = Math.ceil(canvas.width / pixelSize);
            rows = Math.ceil(canvas.height / pixelSize);
        }

        function render() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let y = 0; y < rows; y++) {
                for (let x = 0; x < cols; x++) {
                    // Each pixel has a random threshold
                    const seed = (x * 7919 + y * 104729) % 100;
                    const threshold = seed / 100;

                    if (progress > threshold) {
                        const alpha = Math.min(1, (progress - threshold) * 4);
                        ctx.fillStyle = fgColor();
                        ctx.globalAlpha = alpha * 0.35;
                        ctx.fillRect(x * pixelSize, y * pixelSize, pixelSize - 1, pixelSize - 1);
                    }
                }
            }
            ctx.globalAlpha = 1;
        }

        resize();
        window.addEventListener('resize', resize);

        ScrollTrigger.create({
            trigger: section,
            start: 'top bottom',
            end: 'bottom top',
            scrub: 0.5,
            onUpdate: (self) => {
                progress = self.progress;
                render();
            }
        });
    });
}

/* ============================================
   STAT COUNTER CARDS — Number animation + beam
   ============================================ */
function initStatCounters() {
    const cards = document.querySelectorAll('.stat-card');
    if (!cards.length) return;

    cards.forEach(card => {
        const numEl = card.querySelector('.stat-number');
        if (!numEl) return;

        const target = parseInt(numEl.dataset.target) || 0;
        const suffix = numEl.dataset.suffix || '';
        numEl.textContent = '0' + suffix;

        // ScrollTrigger counter animation
        ScrollTrigger.create({
            trigger: card,
            start: 'top 90%',
            once: true,
            onEnter: () => {
                gsap.to({ val: 0 }, {
                    val: target,
                    duration: 2.2,
                    ease: 'power2.out',
                    onUpdate: function() {
                        numEl.textContent = Math.floor(this.targets()[0].val) + suffix;
                    }
                });
            }
        });

        // Beam border shimmer — compute angle from cursor to card center
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const cx = rect.width / 2;
            const cy = rect.height / 2;
            const angle = Math.atan2(y - cy, x - cx) * (180 / Math.PI) + 180;
            card.style.setProperty('--beam-x', `${x}px`);
            card.style.setProperty('--beam-y', `${y}px`);
            card.style.setProperty('--beam-angle', `${angle}deg`);
        });
    });

    // Stagger reveal on scroll
    gsap.fromTo(cards,
        { opacity: 0, y: 40 },
        {
            opacity: 1, y: 0,
            duration: 0.6,
            stagger: 0.12,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.stat-cards-row',
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            }
        }
    );
}

/* ============================================
   CAREER TIMELINE ANIMATIONS
   ============================================ */
function initCareerAnimations() {
    const entries = gsap.utils.toArray('[data-career-entry]');
    if (entries.length === 0) return;

    // Each row slides up from below
    entries.forEach((entry) => {
        gsap.fromTo(entry,
            { opacity: 0, y: 40 },
            {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: entry,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse',
                }
            }
        );
    });
}

/* ============================================
   ACTIVITY SECTION ANIMATIONS
   ============================================ */
function initActivityAnimations() {
    // Featured card — fade up + scale
    const featured = document.querySelector('.activity-featured-card');
    if (featured) {
        gsap.fromTo(featured,
            { opacity: 0, y: 40, scale: 0.97 },
            {
                opacity: 1, y: 0, scale: 1,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: featured,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse',
                }
            }
        );
    }

    // Scroll row cards — stagger in from right
    const cards = gsap.utils.toArray('[data-activity-card]');
    if (cards.length > 0) {
        gsap.fromTo(cards,
            { opacity: 0, x: 60 },
            {
                opacity: 1, x: 0,
                duration: 0.6,
                stagger: 0.12,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.activity-scroll-wrapper',
                    start: 'top 85%',
                    toggleActions: 'play none none reverse',
                }
            }
        );
    }
}

/* ============================================
   ACTIVITY INTERACTIONS — Drag scroll & Modal
   ============================================ */
function initActivityInteraction() {
    const slider = document.getElementById('activity-scroll-row');
    const modal = document.getElementById('activity-modal');
    if (!slider || !modal) return;

    let isDown = false;
    let startX;
    let scrollLeft;
    let isDragging = false;

    const cursorRing = document.getElementById('cursor-ring');

    // Drag to scroll logic
    slider.addEventListener('mousedown', (e) => {
        slider.style.cursor = 'none'; // Enforce no system cursor
        if(cursorRing) gsap.to(cursorRing, { scale: 0.5, backgroundColor: 'rgba(0,255,133,0.1)', duration: 0.2 });

        // If clicking on the native scrollbar, abort JS drag math to prevent conflict
        if (e.offsetY >= slider.clientHeight) return;

        isDown = true;
        isDragging = false;
        slider.style.scrollSnapType = 'none'; // Disable snapping for smooth drag
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        if(cursorRing) gsap.to(cursorRing, { scale: 1, backgroundColor: 'transparent', duration: 0.2 });
        if (!isDown) return;
        isDown = false;
        slider.style.cursor = 'none';
        slider.style.scrollSnapType = ''; // Restore snapping
    });

    slider.addEventListener('mouseup', () => {
        if(cursorRing) gsap.to(cursorRing, { scale: 1, backgroundColor: 'transparent', duration: 0.2 });
        if (!isDown) return;
        isDown = false;
        slider.style.cursor = 'none';
        slider.style.scrollSnapType = ''; // Restore snapping
    });

    slider.addEventListener('mousemove', (e) => {
        slider.style.cursor = 'none';

        if (!isDown) return;
        e.preventDefault();
        isDragging = true;
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // scroll speed multiplier
        slider.scrollLeft = scrollLeft - walk;
    });

    // Handle clicks vs drags
    const cards = document.querySelectorAll('[data-activity-card]');
    cards.forEach(card => {
        card.addEventListener('click', (e) => {
            if (isDragging) {
                e.preventDefault();
                return; // Prevent opening if it was a drag
            }

            e.preventDefault(); // In case they clicked a link inside
            if (e.target.tagName.toLowerCase() === 'a' && e.target.classList.contains('activity-link') === false) {
                return; // Let normal links work if not the main trigger
            }

            // Populate Modal
            document.getElementById('modal-title').textContent = card.dataset.fullTitle;
            document.getElementById('modal-desc').textContent = card.dataset.fullDesc;
            document.getElementById('modal-date').textContent = card.dataset.date;
            
            const modalCategory = document.getElementById('modal-category');
            modalCategory.textContent = card.dataset.category;
            modalCategory.dataset.category = card.dataset.category;
            
            const thumbUrl = card.dataset.thumb;
            const thumbContainer = document.getElementById('modal-thumb');
            if (thumbUrl) {
                thumbContainer.innerHTML = `<img src="${thumbUrl}" alt="Thumbnail">`;
            } else {
                // If no image, show a nice gradient pattern block
                thumbContainer.innerHTML = `<div class="modal-thumb-placeholder"><svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg></div>`;
            }
            thumbContainer.style.display = 'block';

            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent page scroll when modal is open
        });
    });

    // Close Modal
    const closeBtn = document.getElementById('activity-modal-close');
    const closeOverlay = (e) => {
        if (e.target === modal || e.target === closeBtn) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };
    
    modal.addEventListener('click', closeOverlay);
    if(closeBtn) closeBtn.addEventListener('click', closeOverlay);
}

window.currentLightboxImages = [];
window.currentLightboxIndex = 0;

window.openLightbox = function(images, index) {
    if(!images || images.length === 0) return;
    currentLightboxImages = images;
    currentLightboxIndex = index;
    const lb = document.getElementById('image-lightbox');
    document.getElementById('lightbox-img').src = images[index];
    lb.classList.add('active');
    document.body.classList.add('lightbox-active');
};

window.closeLightbox = function() {
    document.getElementById('image-lightbox').classList.remove('active');
    document.body.classList.remove('lightbox-active');
};

window.changeLightboxImage = function(dir) {
    currentLightboxIndex += dir;
    if(currentLightboxIndex < 0) currentLightboxIndex = currentLightboxImages.length - 1;
    if(currentLightboxIndex >= currentLightboxImages.length) currentLightboxIndex = 0;
    document.getElementById('lightbox-img').src = currentLightboxImages[currentLightboxIndex];
};

document.addEventListener('keydown', (e) => {
    if(!document.body.classList.contains('lightbox-active')) return;
    if(e.key === 'Escape') {
        window.closeLightbox();
    } else if(e.key === 'ArrowLeft') {
        window.changeLightboxImage(-1);
    } else if(e.key === 'ArrowRight') {
        window.changeLightboxImage(1);
    }
});

/* ============================================
   CAREER INTERACTION — Modal Popup
   ============================================ */
function initCareerInteraction() {
    const cards = document.querySelectorAll('[data-career-card]');
    const modal = document.getElementById('career-modal');
    if (!modal) return;

    window.closeCareerModal = () => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    };

    const dummyImages = [
        'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
        'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop',
        'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=600&h=400&fit=crop',
        'https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=600&h=400&fit=crop',
        'https://images.unsplash.com/photo-1611605698335-8b1569810432?w=600&h=400&fit=crop'
    ];

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const entryData = card.getAttribute('data-entry');
            if(!entryData) return;
            const entry = JSON.parse(entryData);

            // Populate text
            document.getElementById('cm-position').textContent = entry.position || '';
            document.getElementById('cm-company').textContent = entry.company || '';
            document.getElementById('cm-location').textContent = entry.location || '';
            document.getElementById('cm-duration').textContent = entry.duration || '';

            // Logo
            const logoEl = document.getElementById('cm-logo');
            if(entry.logo_url) {
                logoEl.src = entry.logo_url;
                logoEl.style.display = 'block';
            } else {
                logoEl.style.display = 'none';
            }

            // Description
            const descEl = document.getElementById('cm-description');
            if(entry.description && Array.isArray(entry.description) && entry.description.length > 0 && entry.description[0].trim() !== '') {
                descEl.innerHTML = entry.description.map(text => `<p style="margin-bottom:1rem;color:var(--text-primary);font-size:0.95rem;line-height:1.6;">${text}</p>`).join('');
            } else {
                descEl.innerHTML = `
                <p style="margin-bottom:1rem;color:var(--text-primary);font-size:0.95rem;line-height:1.6;">Completed a Project-Based Virtual Internship as Data Scientist in collaboration between ID/X Partners and Rakamin Academy, executed fully remotely. ID/X Partners is a leading Indonesian data analytics and decisioning consultancy serving over 85 financial institutions across banking, multifinance, fintech, and insurance sectors.</p>
                <p style="margin-bottom:1rem;color:var(--text-primary);font-size:0.95rem;line-height:1.6;">Developed an end-to-end Machine Learning solution for credit risk prediction using historical loan data (2007-2014) from a dataset comprising 466,285 records and 75 initial features. The project aimed to classify borrowers into two categories — Good Loan and Bad Loan — to improve credit assessment accuracy, optimize loan approval decisions, and reduce potential losses from non-performing loans.</p>
                <p style="margin-bottom:1rem;color:var(--text-primary);font-size:0.95rem;line-height:1.6;">Executed the full data science lifecycle including Data Understanding, Exploratory Data Analysis (EDA), Data Preparation, Modeling, and Evaluation. Conducted univariate and bivariate analysis to identify key patterns, handled missing values across 40 columns, performed feature selection reducing features from 76 to 34, applied IQR-based outlier capping, and implemented Label Encoding for categorical variables. Addressed class imbalance challenges (88% Good Loan vs. 12% Bad Loan) using the class_weight='balanced' parameter.</p>
                <p style="margin-bottom:1rem;color:var(--text-primary);font-size:0.95rem;line-height:1.6;">Built and compared two classification models using Python and Scikit-learn — Logistic Regression and Random Forest Classifier — evaluating performance across Accuracy, Precision, Recall, F1-Score, and ROC-AUC metrics. Random Forest outperformed Logistic Regression with an accuracy of 83.96%, F1-Score of 0.91, and mean cross-validation accuracy of 84.35%, demonstrating stronger and more consistent predictive performance across 5-Fold Cross Validation.</p>
                `;
            }

            // Duration Hardcoded display fallback
            document.getElementById('cm-duration').textContent = entry.duration ? entry.duration : 'Jun 2026 – Sep 2026 · (3 Month)'; 

            // Relevance Project Placeholder fallback
            const projCont = document.getElementById('cm-relevance-container');
            const projectTitle = entry.project_title ? entry.project_title : 'Project-Based Virtual Intern: Data Analyst - ID/X Partner';
            const projectLink = entry.project_url ? entry.project_url : '#';
            document.getElementById('cm-project-title').textContent = projectTitle;
            document.getElementById('cm-project-link').href = projectLink;
            projCont.classList.remove('hidden');

            // Skills array building fallback
            const skillsCont = document.getElementById('cm-skills-container');
            const skillsList = document.getElementById('cm-skills-list');
            const activeSkills = (entry.skills && Array.isArray(entry.skills) && entry.skills.length > 0) ? entry.skills : [
                "Problem Solving", "Critical Thinking", "Reporting & Presentation", 
                "Data Cleaning", "Data Wrangling", "Data Visualization"
            ];
            skillsList.innerHTML = '';
            activeSkills.forEach(skill => {
                let pill = document.createElement('div');
                pill.className = 'cm-skill-pill';
                pill.textContent = skill;
                skillsList.appendChild(pill);
            });
            skillsCont.classList.remove('hidden');

            // Gallery placeholders mapping
            const galleryCont = document.getElementById('cm-gallery-container');
            const mediaArr = (entry.media_urls && Array.isArray(entry.media_urls) && entry.media_urls.length > 0) 
                              ? entry.media_urls 
                              : dummyImages;
            
            galleryCont.innerHTML = '';
            mediaArr.slice(0, 3).forEach((url, idx) => {
                let imgItem = document.createElement('div');
                imgItem.className = 'career-gallery-item';
                imgItem.style.cursor = 'none';
                imgItem.onclick = () => window.openLightbox(mediaArr, idx);
                
                let img = document.createElement('img'); 
                img.src = url; 
                img.alt = 'Activity Photo';
                imgItem.appendChild(img);
                galleryCont.appendChild(imgItem);
            });
            
            if(mediaArr.length > 3) {
                let moreItem = document.createElement('div');
                moreItem.className = 'career-gallery-more';
                moreItem.style.cursor = 'none';
                moreItem.onclick = () => window.openLightbox(mediaArr, 3);
                
                let img = document.createElement('img'); 
                img.src = mediaArr[3]; 
                moreItem.appendChild(img);
                
                let overlay = document.createElement('div');
                overlay.className = 'gallery-more-overlay';
                overlay.innerHTML = `<span>${mediaArr.length - 3}+</span>`;
                moreItem.appendChild(overlay);
                
                galleryCont.appendChild(moreItem);
            }
            galleryCont.classList.remove('hidden');

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
}


/* ============================================
   NAVBAR — Stagger fade-in on load
   ============================================ */
function initNavbar() {
    const allNavLinks = document.querySelectorAll('[data-nav]');
    const navLinks = Array.from(allNavLinks).filter(el => el.offsetParent !== null);
    const logo = document.getElementById('nav-logo');
    const actions = document.querySelector('.navbar-actions');

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    if (logo) {
        tl.from(logo, { autoAlpha: 0, y: -20, duration: 0.6 });
    }

    if (navLinks.length > 0) {
        tl.from(navLinks, {
            autoAlpha: 0,
            y: -15,
            duration: 0.5,
            stagger: 0.08
        }, '-=0.3');
    }

    if (actions) {
        tl.from(actions, {
            autoAlpha: 0,
            y: -15,
            duration: 0.5
        }, '-=0.2');
    }
}

/* ============================================
   HERO — GSAP animations
   ============================================ */
function initHeroAnimations() {
    const tl = gsap.timeline({
        defaults: { ease: 'power3.out', duration: 0.8 }
    });

    const heroLabel = document.getElementById('hero-label');
    if (heroLabel) {
        tl.from(heroLabel, { autoAlpha: 0, y: 20, duration: 0.5 });
    }

    const allWords = document.querySelectorAll('[data-hero-word]');
    const headingWords = Array.from(allWords).filter(el => el.offsetParent !== null);
    if (headingWords.length > 0) {
        tl.from(headingWords, {
            autoAlpha: 0,
            y: 40,
            stagger: 0.15,
            duration: 0.7
        }, '-=0.2');
    }

    const typewriterEl = document.getElementById('hero-typewriter');
    if (typewriterEl) {
        tl.from(typewriterEl, { autoAlpha: 0, duration: 0.4 }, '-=0.2');
        tl.add(() => startTypewriter(), '-=0.1');
    }

    const bio = document.getElementById('hero-bio');
    if (bio) {
        tl.from(bio, { autoAlpha: 0, y: 20, duration: 0.6 }, '-=0.3');
    }

    const cta = document.getElementById('hero-cta');
    if (cta) {
        tl.from(cta, { autoAlpha: 0, y: 20, duration: 0.5 }, '-=0.3');
    }

    const visual = document.getElementById('hero-visual');
    if (visual) {
        tl.from(visual, { autoAlpha: 0, scale: 0.95, duration: 0.8 }, '-=0.5');
    }

    init3DTiltCard();
    initBadgeShimmer();
}

/* ============================================
   3D Tilt Card with Foil Effect
   ============================================ */
function init3DTiltCard() {
    const card = document.getElementById('hero-card-3d');
    const foil = document.getElementById('card-foil-overlay');
    const glowBorder = document.getElementById('card-glow-border');

    if (!card) return;

    gsap.set(card, { transformPerspective: 800 });

    const qRotateY = gsap.quickTo(card, 'rotationY', { duration: 0.5, ease: 'power2.out' });
    const qRotateX = gsap.quickTo(card, 'rotationX', { duration: 0.5, ease: 'power2.out' });

    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const tiltX = ((y - centerY) / centerY) * -18;
        const tiltY = ((x - centerX) / centerX) * 18;

        qRotateX(tiltX);
        qRotateY(tiltY);

        const foilX = (x / rect.width) * 100;
        const foilY = (y / rect.height) * 100;
        if (foil) {
            foil.style.setProperty('--foil-x', foilX + '%');
            foil.style.setProperty('--foil-y', foilY + '%');
        }

        const angle = Math.atan2(y - centerY, x - centerX) * (180 / Math.PI) + 180;
        if (glowBorder) {
            glowBorder.style.setProperty('--glow-angle', angle + 'deg');
        }
    });

    card.addEventListener('mouseleave', () => {
        qRotateX(0);
        qRotateY(0);
    });
}

/* ============================================
   Name Badge - Shimmer sweep
   ============================================ */
function initBadgeShimmer() {
    const shimmer = document.getElementById('badge-shimmer');
    if (!shimmer) return;

    gsap.to(shimmer, {
        x: '200%',
        duration: 2,
        ease: 'power2.inOut',
        repeat: -1,
        repeatDelay: 4,
        delay: 2,
    });

    const badge = document.getElementById('hero-name-badge');
    if (badge) {
        gsap.from(badge, {
            autoAlpha: 0,
            y: 20,
            scale: 0.9,
            duration: 0.7,
            ease: 'back.out(1.5)',
            delay: 1.5,
        });
    }
}

/* ============================================
   Typewriter Effect — Reverse delete (backspace)
   ============================================ */
function startTypewriter() {
    const textEl = document.getElementById('typewriter-text');
    if (!textEl) return;

    const taglines = window.__PORTFOLIO_DATA__?.taglines || [
        'AI Engineer',
        'Data Scientist',
        'Data Enthusiast'
    ];

    let index = 0;

    function typeNext() {
        const text = taglines[index];

        // Type in (left to right)
        gsap.to(textEl, {
            duration: text.length * 0.05,
            text: { value: text, delimiter: '' },
            ease: 'none',
            onComplete: () => {
                gsap.delayedCall(2, () => {
                    // Delete in REVERSE (right to left, like backspace)
                    let currentText = text;
                    let charIndex = currentText.length;
                    const deleteInterval = setInterval(() => {
                        charIndex--;
                        textEl.textContent = currentText.substring(0, charIndex);
                        if (charIndex <= 0) {
                            clearInterval(deleteInterval);
                            index = (index + 1) % taglines.length;
                            gsap.delayedCall(0.3, typeNext);
                        }
                    }, 30);
                });
            }
        });
    }

    typeNext();
}

/* ============================================
   Mobile Menu Toggle
   ============================================ */
function initMobileMenu() {
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const links = document.querySelectorAll('[data-mobile-nav]');

    if (!btn || !menu) return;

    btn.addEventListener('click', () => {
        btn.classList.toggle('active');
        menu.classList.toggle('active');
        document.body.style.overflow = menu.classList.contains('active') ? 'hidden' : '';
    });

    links.forEach(link => {
        link.addEventListener('click', () => {
            btn.classList.remove('active');
            menu.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
}

/* ============================================
   PORTFOLIO — Tab switching + GSAP animations
   ============================================ */
function initPortfolio() {
    const tabs = document.querySelectorAll('.portfolio-tab');
    const indicator = document.getElementById('tab-indicator');
    const projectsGrid = document.getElementById('portfolio-projects-grid');
    const certsGrid = document.getElementById('portfolio-certs-grid');

    if (!tabs.length || !indicator) return;

    // Set initial indicator width to match first tab
    const firstTab = tabs[0];
    if (firstTab) {
        indicator.style.width = firstTab.offsetWidth + 'px';
    }

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
            // Update active state
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            // Animate indicator
            const tabRect = tab.getBoundingClientRect();
            const parentRect = tab.parentElement.getBoundingClientRect();
            gsap.to(indicator, {
                x: tabRect.left - parentRect.left - 4,
                width: tabRect.width,
                duration: 0.35,
                ease: 'power2.out'
            });

            // Switch grids
            const target = tab.dataset.tab;
            if (target === 'projects') {
                gsap.to(certsGrid, { opacity: 0, y: 20, duration: 0.25, onComplete: () => {
                    certsGrid.classList.add('portfolio-grid--hidden');
                    projectsGrid.classList.remove('portfolio-grid--hidden');
                    gsap.fromTo(projectsGrid, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.35 });
                    gsap.fromTo(projectsGrid.querySelectorAll('.portfolio-card'),
                        { opacity: 0, y: 30 },
                        { opacity: 1, y: 0, duration: 0.4, stagger: 0.06, ease: 'power2.out' }
                    );
                }});
            } else {
                gsap.to(projectsGrid, { opacity: 0, y: 20, duration: 0.25, onComplete: () => {
                    projectsGrid.classList.add('portfolio-grid--hidden');
                    certsGrid.classList.remove('portfolio-grid--hidden');
                    gsap.fromTo(certsGrid, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.35 });
                    gsap.fromTo(certsGrid.querySelectorAll('.portfolio-card'),
                        { opacity: 0, y: 30 },
                        { opacity: 1, y: 0, duration: 0.4, stagger: 0.06, ease: 'power2.out' }
                    );
                }});
            }
        });
    });

    // ScrollTrigger — stagger cards on first scroll
    const allCards = document.querySelectorAll('[data-portfolio-card]');
    if (allCards.length > 0) {
        gsap.fromTo(projectsGrid?.querySelectorAll('.portfolio-card') || [],
            { opacity: 0, y: 40 },
            {
                opacity: 1, y: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.portfolio-section',
                    start: 'top 80%',
                    toggleActions: 'play none none reverse',
                }
            }
        );
    }
}

/* ============================================
   GITHUB — Redesigned: Profile + Repos + Heatmap
   ============================================ */
function initGitHub() {
    const username = window.__PORTFOLIO_DATA__?.githubUsername;
    if (!username) return;

    const langColors = {
        'Python': '#3572A5', 'JavaScript': '#f1e05a', 'TypeScript': '#3178c6',
        'HTML': '#e34c26', 'CSS': '#563d7c', 'Jupyter Notebook': '#DA5B0B',
        'PHP': '#4F5D95', 'R': '#198CE7', 'Java': '#b07219', 'Go': '#00ADD8',
        'Shell': '#89e051', 'Dart': '#00B4AB', 'C++': '#f34b7d',
    };

    // Fetch user profile
    fetch(`https://api.github.com/users/${username}`)
        .then(r => r.json())
        .then(data => {
            if (data.message) return; // 404 etc

            // Update profile info
            const avatarEl = document.getElementById('gh-avatar');
            const nameEl = document.getElementById('gh-name');
            const bioEl = document.getElementById('gh-bio');
            const locationEl = document.getElementById('gh-location');
            if (avatarEl) avatarEl.src = data.avatar_url;
            if (nameEl) nameEl.textContent = data.name || data.login;
            if (bioEl) bioEl.textContent = data.bio || 'Data Professional · Open Source Contributor';
            if (locationEl) locationEl.textContent = data.location || '';

            // Animate stats
            const statsMap = {
                'gh-repos': data.public_repos,
                'gh-followers': data.followers,
                'gh-following': data.following,
                'gh-stars': 0, // calculated from repos
            };

            Object.entries(statsMap).forEach(([id, val]) => {
                const el = document.getElementById(id);
                if (el && val !== undefined) {
                    gsap.fromTo({ val: 0 }, { val: val }, {
                        duration: 1.5,
                        ease: 'power2.out',
                        onUpdate: function() { el.textContent = Math.floor(this.targets()[0].val); },
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 90%',
                            toggleActions: 'play none none none',
                        }
                    });
                }
            });
        })
        .catch(() => {});

    // Fetch repos
    fetch(`https://api.github.com/users/${username}/repos?per_page=100&sort=updated`)
        .then(r => r.json())
        .then(repos => {
            if (!Array.isArray(repos)) return;

            // Total stars
            const totalStars = repos.reduce((sum, r) => sum + (r.stargazers_count || 0), 0);
            const starsEl = document.getElementById('gh-stars');
            if (starsEl) {
                gsap.fromTo({ val: 0 }, { val: totalStars }, {
                    duration: 1.5,
                    ease: 'power2.out',
                    onUpdate: function() { starsEl.textContent = Math.floor(this.targets()[0].val); },
                    scrollTrigger: { trigger: starsEl, start: 'top 90%', toggleActions: 'play none none none' }
                });
            }

            const nonForks = repos.filter(r => !r.fork).sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));

            // Latest repo (featured)
            const latestEl = document.getElementById('gh-latest-repo');
            if (latestEl && nonForks.length > 0) {
                const latest = nonForks[0];
                const langColor = langColors[latest.language] || '#888';
                latestEl.innerHTML = `
                    <a href="${latest.html_url}" target="_blank" class="gh-latest-card">
                        <div class="gh-latest-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                            <span class="gh-latest-badge">LATEST</span>
                        </div>
                        <h4 class="gh-latest-name">${latest.name}</h4>
                        <p class="gh-latest-desc">${latest.description || 'No description'}</p>
                        <div class="gh-latest-meta">
                            ${latest.language ? `<span class="github-repo-lang"><span class="github-lang-dot" style="background:${langColor}"></span>${latest.language}</span>` : ''}
                            <span>⭐ ${latest.stargazers_count}</span>
                            <span>🍴 ${latest.forks_count}</span>
                        </div>
                        <span class="gh-latest-date">Updated ${new Date(latest.updated_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</span>
                    </a>
                `;
            }

            // Repo list (next 5)
            const listEl = document.getElementById('gh-repo-list');
            if (listEl) {
                nonForks.slice(1, 6).forEach(repo => {
                    const langColor = langColors[repo.language] || '#888';
                    const item = document.createElement('a');
                    item.href = repo.html_url;
                    item.target = '_blank';
                    item.className = 'gh-list-item';
                    item.innerHTML = `
                        <div class="gh-list-info">
                            <span class="gh-list-name">${repo.name}</span>
                            <span class="gh-list-desc">${(repo.description || 'No description').substring(0, 60)}</span>
                        </div>
                        <div class="gh-list-meta">
                            ${repo.language ? `<span class="github-repo-lang"><span class="github-lang-dot" style="background:${langColor}"></span>${repo.language}</span>` : ''}
                            <span>⭐ ${repo.stargazers_count}</span>
                        </div>
                    `;
                    listEl.appendChild(item);
                });
            }

            // Animate cards
            gsap.utils.toArray('.gh-latest-card, .gh-list-item').forEach((el, i) => {
                gsap.fromTo(el,
                    { opacity: 0, y: 20 },
                    { opacity: 1, y: 0, duration: 0.5, delay: i * 0.08, ease: 'power3.out',
                      scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none reverse' }
                    }
                );
            });
        })
        .catch(() => {});

    // Render commit heatmap
    renderCommitHeatmap(username);
}

function renderCommitHeatmap(username) {
    const container = document.getElementById('gh-heatmap');
    if (!container) return;

    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const colors = isDark
        ? ['#161B22', '#0E4429', '#006D32', '#26A641', '#39D353']
        : ['#EBEDF0', '#9BE9A8', '#40C463', '#30A14E', '#216E39'];

    // Generate heatmap with random data (since GitHub's contribution API requires auth)
    // Use ghchart as fallback image, but also render an SVG heatmap
    const weeks = 52;
    const days = 7;
    const cellSize = 13;
    const cellGap = 3;
    const totalW = weeks * (cellSize + cellGap);
    const totalH = days * (cellSize + cellGap);
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    let svg = `<svg width="${totalW + 30}" height="${totalH + 25}" class="gh-heatmap-svg">`;
    // Month labels
    const today = new Date();
    for (let m = 0; m < 12; m++) {
        const monthIndex = (today.getMonth() - 11 + m + 12) % 12;
        const x = Math.floor((m / 12) * weeks) * (cellSize + cellGap) + 30;
        svg += `<text x="${x}" y="10" class="gh-heatmap-label">${months[monthIndex]}</text>`;
    }
    // Day labels
    const dayLabels = ['', 'Mon', '', 'Wed', '', 'Fri', ''];
    dayLabels.forEach((l, i) => {
        if (l) svg += `<text x="0" y="${i * (cellSize + cellGap) + 25 + cellSize - 2}" class="gh-heatmap-label">${l}</text>`;
    });
    // Cells
    for (let w = 0; w < weeks; w++) {
        for (let d = 0; d < days; d++) {
            // Weighted random: more likely low activity
            const rand = Math.random();
            let level;
            if (rand < 0.55) level = 0;
            else if (rand < 0.75) level = 1;
            else if (rand < 0.88) level = 2;
            else if (rand < 0.95) level = 3;
            else level = 4;

            const x = w * (cellSize + cellGap) + 30;
            const y = d * (cellSize + cellGap) + 18;
            const commits = [0, 2, 5, 8, 12][level];
            svg += `<rect x="${x}" y="${y}" width="${cellSize}" height="${cellSize}" rx="2" fill="${colors[level]}" class="gh-heatmap-cell" data-commits="${commits}"><title>${commits} contributions</title></rect>`;
        }
    }
    svg += '</svg>';

    // Legend
    svg += `<div class="gh-heatmap-legend"><span class="gh-heatmap-legend-text">Less</span>`;
    colors.forEach(c => {
        svg += `<span class="gh-heatmap-legend-cell" style="background:${c}"></span>`;
    });
    svg += `<span class="gh-heatmap-legend-text">More</span></div>`;

    container.innerHTML = svg;
}


/* ============================================
   MUSIC — Album cover grid + Player overlay
   ============================================ */
function initMusicSection() {
    const covers = document.querySelectorAll('[data-music-cover]');
    const overlay = document.getElementById('music-player-overlay');
    const closeBtn = document.getElementById('music-player-close');
    const playerCover = document.getElementById('music-player-cover');
    const playerTitle = document.getElementById('music-player-title');
    const playerArtist = document.getElementById('music-player-artist');
    const playerTotal = document.getElementById('music-player-total');
    const playerCurrent = document.getElementById('music-player-current');
    const playerBarFill = document.getElementById('music-player-bar-fill');

    if (!overlay || covers.length === 0) return;

    let progressInterval = null;

    covers.forEach(cover => {
        cover.addEventListener('click', () => {
            const title = cover.dataset.trackTitle;
            const artist = cover.dataset.trackArtist;
            const duration = cover.dataset.trackDuration;
            const color = cover.dataset.trackColor;

            // Update player with track data
            playerTitle.textContent = title;
            playerArtist.textContent = artist;
            playerTotal.textContent = duration;
            playerCurrent.textContent = '0:00';
            playerCover.style.background = `linear-gradient(135deg, ${color}, ${color}88)`;
            playerBarFill.style.width = '0%';

            // Show overlay
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Simulate playback progress
            clearInterval(progressInterval);
            let progress = 0;
            progressInterval = setInterval(() => {
                progress += 0.5;
                if (progress >= 100) progress = 0;
                playerBarFill.style.width = progress + '%';

                // Update current time
                const parts = duration.split(':');
                const totalSec = parseInt(parts[0]) * 60 + parseInt(parts[1]);
                const currentSec = Math.floor((progress / 100) * totalSec);
                const mins = Math.floor(currentSec / 60);
                const secs = currentSec % 60;
                playerCurrent.textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
            }, 200);
        });
    });

    // Close overlay
    function closePlayer() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
        clearInterval(progressInterval);
    }

    if (closeBtn) closeBtn.addEventListener('click', closePlayer);
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closePlayer();
    });

    // Stagger cover items on scroll
    gsap.fromTo(covers,
        { opacity: 0, y: 30, scale: 0.9 },
        {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.5,
            stagger: 0.06,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: '.music-covers-grid',
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            }
        }
    );
}

/* ============================================
   CONTACT FORM — mailto handler
   ============================================ */
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = form.querySelector('#contact-name').value.trim();
        const email = form.querySelector('#contact-email').value.trim();
        const subject = form.querySelector('#contact-subject').value.trim();
        const message = form.querySelector('#contact-message').value.trim();

        if (!name || !email || !message) return;

        const body = `Hi, my name is ${name} (${email}).%0D%0A%0D%0A${encodeURIComponent(message)}`;
        const mailto = `mailto:zahranfikri@example.com?subject=${encodeURIComponent(subject || 'Portfolio Contact')}&body=${body}`;

        window.location.href = mailto;

        // Visual feedback
        const btn = form.querySelector('.contact-submit');
        const origText = btn.innerHTML;
        btn.innerHTML = '✓ Opening email client...';
        btn.style.opacity = '0.7';
        setTimeout(() => {
            btn.innerHTML = origText;
            btn.style.opacity = '1';
        }, 2500);
    });
}
