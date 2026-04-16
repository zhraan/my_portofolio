Build a stunning, production-grade personal portfolio website with DUAL THEME MODE
(Light + Dark toggle) based on the two reference designs provided.

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
⚙️ TECH STACK
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

- Framework : Laravel 11 (backend, routing, Blade templating)
- Styling : Tailwind CSS v4
- Animation : GSAP 3 (ScrollTrigger, TextPlugin, MotionPathPlugin)
  — ALL animations (scroll reveal, typewriter, marquee,
  hover effects, music player transitions) must use GSAP
- Database : PostgreSQL via Laragon (local dev)
- Auth : Laravel Breeze / built-in Laravel Auth
  (single admin login to manage content)
- JavaScript : Node.js + Vite (asset bundling)
- GitHub API : MCP GitHub connector for commit heatmap
  and latest repositories data
- Music Player : Custom GSAP-powered player (no external player embed)
- Icons : Lucide Blade + Devicons CDN for tech stack logos
- Fonts :
  DARK MODE → "Share Tech Mono" (headings) + "Rajdhani" (body)
  LIGHT MODE → "DM Sans" (headings) + "Inter" (body)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🎨 DUAL THEME DESIGN SYSTEM
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

/_ ── DARK MODE: Futuristic Glass ── _/
--dark-bg-primary: #0A0A0A
--dark-bg-secondary: #111111
--dark-bg-glass: rgba(255,255,255,0.04)
--dark-border-glass: rgba(255,255,255,0.08)
--dark-accent: #00FF85 ← neon green (exact from reference)
--dark-accent-dim: #00CC6A
--dark-text-primary: #FFFFFF
--dark-text-muted: #888888
--dark-highlight: #1A1A1A
--dark-grid-dot: rgba(255,255,255,0.06) ← dot grid bg pattern

/_ ── LIGHT MODE: Minimalist Emerald ── _/
--light-bg-primary: #FFFFFF
--light-bg-secondary: #F5F5F5
--light-border: #E5E5E5
--light-accent: #10B981 ← emerald green (exact from reference)
--light-accent-dark: #059669
--light-text-primary: #0A0A0A
--light-text-muted: #6B7280
--light-highlight: #F0FDF4

/_ ── SHARED ── _/
--transition-theme: all 0.4s cubic-bezier(0.4, 0, 0.2, 1)

THEME SWITCHING:

- Toggle button in header: Sun ☀ / Moon ☾ icon
- Smooth GSAP timeline transition between themes (0.4s)
- Theme preference saved to localStorage
- All CSS variables swap via [data-theme="dark"] / [data-theme="light"]
  on the <html> element
- Background pattern:
  DARK → subtle dot grid (CSS background radial-gradient)
  LIGHT → clean white, no pattern

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🧭 NAVIGATION HEADER
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
DARK MODE style (ref: left image):

- Logo left: "YOUR_NAME_OS" in mono font, green accent
- Nav links: PROJECTS · STACK · CAREER · ACTIVITY · GITHUB · MUSIC
  in uppercase mono, spaced, green active underline
- Right side: <> icon + theme toggle button + admin login icon

LIGHT MODE style (ref: right image):

- Logo left: "Your Name" in clean sans-serif
- Nav center: Home · Projects · About · Contact (clean, no caps)
- Right side: "Resume" green filled pill button + theme toggle

SHARED:

- Sticky on scroll with blur backdrop
- GSAP fade-in on page load (staggered links)
- Mobile: hamburger → full screen overlay menu

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 1 — HERO / PROFILE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: profiles table (PostgreSQL)

Layout: Two columns — LEFT text, RIGHT photo

--- DARK MODE (ref: left image) ---

- Small status badge top: "SYSTEM STATUS: OPERATIONAL // V.4.0.2"
  in green mono font (update this with your real tagline)
- Name heading: MASSIVE bold uppercase, white
  Example: "ARCHITECTING" line 1 (white)
  "DATA" line 2 (neon green, same massive size)
  "INTELLIGENCE" line 3 (white)
- Typewriter effect (GSAP TextPlugin) cycling through roles BELOW heading:
  "> AI Engineer*" | "> Data Scientist*" | "> Data Enthusiast*" |
  "> Data-Driven Developer*"
  — mono font, green color, blinking cursor via GSAP repeat
- Bio: 2-3 lines muted text
- CTA buttons:
  [ INITIALIZE PROJECT ] ← green filled, mono caps
  [ VIEW STACK ] ← ghost outlined
- Right side: 3D or abstract data visualization orb/cube
  (use CSS + GSAP rotation animation — no external 3D lib needed)
  OR profile photo inside a hex frame with neon green glow border animation
- Background: dark dot grid, subtle GSAP floating particles (canvas)

--- LIGHT MODE (ref: right image) ---

- Small label top: "SOFTWARE ENGINEERING EXCELLENCE"
  in emerald small-caps, letter-spaced
- Heading: Large bold sans-serif, mixed color:
  "Building Data" (black)
  "Systems with" (black)
  "Precision." (emerald green)
- Same GSAP typewriter below heading (clean sans, emerald color)
- Bio paragraph in clean muted gray
- CTA buttons:
  [ View Selected Works ] ← emerald filled
  [ The Methodology → ] ← text link with arrow
- Right: Profile photo, clean grayscale or colored,
  in a subtle rounded frame with thin emerald border
- Background: pure white, clean

GSAP ANIMATIONS (both modes):

- Page load: GSAP timeline, heading words stagger in from y:40
- Photo: fade + scale from 0.95 → 1
- CTA buttons: slide up with delay

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 2 — SKILLS / TECH STACK MARQUEE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: skills table (PostgreSQL)

THIS SECTION IS A FULL-WIDTH DIVIDER BETWEEN HERO AND CAREER.
No section heading. Pure marquee strip, edge-to-edge.

THREE ROWS of infinite marquee (GSAP):

- Row 1: moves LEFT continuously, STOPS on hover (GSAP pause)
- Row 2: moves RIGHT continuously, STOPS on hover
- Row 3: moves LEFT continuously, STOPS on hover
  (alternating direction = striped motion effect)

Each skill item: [ LOGO ICON + SKILL NAME ]
Style DARK: pill badge — glass bg, green border, white text
Style LIGHT: pill badge — white bg, emerald border, dark text

Skill list (with Devicons/SVG logos):
Row 1: Python · Pandas · NumPy · Matplotlib · Plotly · Seaborn · R
Row 2: TensorFlow · Keras · Scikit-learn · HuggingFace · LangChain · PyTorch
Row 3: Power BI · Tableau · Looker · Microsoft Fabric · Excel/Spreadsheet ·
Apache Spark · Airflow · dbt · PostgreSQL · BigQuery

GSAP implementation:

- Use gsap.to() with x: "-=totalWidth" and repeat: -1 for infinite
- On mouseenter: gsap.pauseTween() | On mouseleave: gsap.resumeTween()
- Duplicate items in DOM for seamless loop
- Row heights: 52px each, gap between rows: 0 (flush divider)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 3 — CAREER JOURNEY
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: career_entries table (PostgreSQL)

DARK: vertical timeline, glowing green center line, glass cards
LIGHT: vertical timeline, thin emerald line, clean white cards

Each card contains:

- Company logo (linked like LinkedIn-style logo from logo_url)
- Company name + position title
- Duration badge (computed from start_date / end_date)
- Type badge: "Internship" (gold/amber) | "Full-time" (green)
- 3-4 achievement bullet points
- MEDIA SECTION: photo or media attachment (image carousel
  using GSAP for slide transitions, up to 3 images per entry)
  — stored in PostgreSQL as media_urls JSON array

Layout: alternating LEFT / RIGHT cards on desktop (centered timeline)
Mobile: single column

GSAP ScrollTrigger animations:

- Timeline line draws itself downward as user scrolls
- Cards slide in from left/right alternately with fade
- Achievement bullets stagger in one by one

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 4 — MY ACTIVITY
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: activities table (PostgreSQL), ordered by date DESC

LAYOUT — TWO ROWS:

ROW 1 — FEATURED / LATEST:
Single large card, full width (or 2/3 width centered)

- Label badge: "LATEST" (green pill, pulsing dot animation via GSAP)
- Large thumbnail image
- Category tag pill
- Title (large, bold)
- Full description (not truncated)
- Date + "Read more →" link
- LOGIC: always shows the most recently uploaded activity
  (latest by created_at from DB)

ROW 2 — HORIZONTAL FLEX SCROLL:
Horizontal scrollable row of activity cards (snap scroll)
Each card: thumbnail + category tag + title + short desc + date
Cards are smaller than the featured card
Hover: card lifts with GSAP scale(1.03) + shadow

DARK: cards use glass morphism (rgba bg + blur border)
LIGHT: cards use white bg with thin border + subtle shadow

GSAP:

- Row 1 card: ScrollTrigger fade up + scale from 0.97
- Row 2 cards: stagger slide in from right on scroll

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 5 — PORTFOLIO SHOWCASE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: portfolios table (PostgreSQL), type: project / certification

Section heading centered, then TWO tab buttons:
[ Portfolio ] [ Certification ]
(GSAP-animated tab indicator slides between tabs)

GRID: 3 columns × 5 rows max (15 visible), "Show More" expands remainder

━━ PORTFOLIO CARD — "Art Gallery Wall" style ━━

Each card simulates a framed artwork in a gallery:

FRAME:

- Outer ornamental border:
  DARK → double-line neon green frame
  (3px solid accent + inner 1px inset at 6px padding)
  LIGHT → double-line emerald frame, same structure
- Default state: brightness(0.65) — slightly darkened, like
  art in a dimmed gallery before spotlight hits

NAMETAG PLATE (below image, inside card):

- Small rectangular plate with GREEN GRADIENT background:
  gradient: linear-gradient(135deg, #00FF85, #00CC6A) [dark]
  gradient: linear-gradient(135deg, #10B981, #059669) [light]
- Project title in white/dark font on the gradient plate
- Tech tags as small white pills overlapping the bottom of image

HOVER EFFECT — DUAL SPOTLIGHT:
On hover, trigger GSAP:

1. Brightness restores to 1.0 (GSAP to brightness:1)
2. TWO spotlight cones appear via CSS radial-gradient overlays:
   spotlight-left: radial-gradient(ellipse at 10% 0%,
   rgba(255,220,120,0.5) 0%, transparent 55%)
   spotlight-right: radial-gradient(ellipse at 90% 0%,
   rgba(255,220,120,0.4) 0%, transparent 55%)
   These overlays fade in with GSAP opacity 0→1 over 0.35s
3. Frame border brightens / pulses slightly

CARD BOTTOM:

- GitHub icon link + External link icon (appear on hover)
- Short description (1 line, truncated)

CERTIFICATION CARD:

- Same frame treatment
- Cert image fills frame
- Nametag plate: issuer + date
- "View Certificate →" link

GSAP ScrollTrigger:

- Cards stagger in from bottom, 0.08s delay between each

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 6 — GITHUB DASHBOARD
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: GitHub API via MCP GitHub connector
Fetched and cached daily in github_stats table (PostgreSQL)

LAYOUT: Two columns side by side

LEFT COLUMN (2/3 width) — CONTRIBUTION HEATMAP:

- Section label: "// GITHUB" mono caps
- Heading: "GitHub Activity"
- GitHub-style 52×7 contribution grid:
  KEEP GITHUB'S ORIGINAL GREEN COLORS:
  0 commits → #161B22 (dark) / #EBEDF0 (light)
  1-3 → #0E4429 (dark) / #9BE9A8 (light)
  4-6 → #006D32 (dark) / #40C463 (light)
  7-9 → #26A641 (dark) / #30A14E (light)
  10+ → #39D353 (dark) / #216E39 (light)
- Month labels below grid in mono font
- Hover tooltip: "X commits on [Date]"
- Legend: Less ■■■■■ More in GitHub greens
- Stats row below:
  [ Total Commits ] [ Longest Streak ] [ Most Active Month ]
  Numbers in large green mono font, labels in small muted text

RIGHT COLUMN (1/3 width) — LATEST REPOSITORIES:

- Heading: "Recent Repos"
- Fetched live from GitHub API (via MCP GitHub connector)
- List of 4-5 latest public repositories, each showing:
  → Repo name (bold, green on hover)
  → Description (1 line, muted)
  → Language tag pill (color-coded by language)
  → Star count ⭐ + Fork count 🍴
  → Last updated date
  → "View on GitHub →" link
- Cards: DARK → glass card | LIGHT → white card with border
- GSAP ScrollTrigger: cards stagger in from right

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🟢 SECTION 7 — MY FAVORITE SONGS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Data source: songs table (PostgreSQL)
Music files: stored in /storage/app/public/music/ (Laravel storage)
Use songs by Alec Benjamin as placeholder tracks

GRID: 4 columns × 4 rows = 16 song tiles (square, equal size)

TILE DESIGN:

- Album cover image (fills tile, object-cover, aspect-ratio: 1/1)
- Default: slight sepia/dark overlay (GSAP default state)
- Hover: GSAP removes overlay + green glow border appears +
  scale(1.04) + play button icon fades in center

ON CLICK → OPEN MUSIC PLAYER:

━━ FULL MUSIC PLAYER (Spotify-inspired) ━━
Opens as a full overlay / drawer panel (GSAP slide up from bottom)

Left panel:

- Large album cover (spinning slowly via GSAP rotation when playing)
- Song title + artist name
- "NOW PLAYING" badge with animated green waveform bars (GSAP)

Center panel:

- SCROLLING LYRICS: lyrics stored in DB as timestamped JSON
  Current line highlighted (white, larger), past lines muted,
  future lines dimmed — auto-scrolls in sync with audio currentTime
  (use JS audio.currentTime + requestAnimationFrame)

Right controls:

- Progress bar (GSAP-animated, clickable scrubber)
- Current time / total duration
- Control buttons: ⏮ Previous | ⏪ -10s | ▶/⏸ Play/Pause |
  ⏩ +10s | ⏭ Next
- Volume slider (GSAP animated fill)
- Shuffle 🔀 + Repeat 🔁 toggles (green when active)

━━ MINI ISLAND (when player is minimized) ━━

- A floating pill/island fixed at bottom-center of screen
- Default collapsed state: shows album cover (tiny) + song title
  - animated waveform bars + ▶/⏸ button
    Width: ~280px, height: ~52px, border-radius: 26px
    DARK: dark glass bg + green border glow
    LIGHT: white bg + emerald border + shadow
- GSAP hover animation: island EXPANDS upward to show:
  → Album cover (larger)
  → Song title + artist
  → Full progress bar
  → Control buttons row
  → Waveform visualizer (canvas, Web Audio API FFT bars)
  Expansion: GSAP timeline with height + opacity + scale ease
- Click island → reopens full player

MUSIC VISUALIZER inside expanded island:

- Web Audio API: AudioContext + AnalyserNode + FFT
- Canvas bars: green color, animated in sync with audio frequency data
- requestAnimationFrame loop updates canvas bars

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🗄️ DATABASE SCHEMA (PostgreSQL via Laragon)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
profiles:
id, name, taglines (json array), bio, photo_url,
cv_url, social_links (json), updated_at

skills:
id, name, logo_url, category, row_number (1/2/3), order

career_entries:
id, company, logo_url, position, type, start_date, end_date,
achievements (json), media_urls (json), order

activities:
id, title, description, category, thumbnail_url, date,
is_featured (bool), created_at

portfolios:
id, title, description, thumbnail_url, tags (json),
github_url, demo_url, type (project/certification),
issuer, issued_date, cert_url, created_at

github_stats:
id, date, commit_count, fetched_at

songs:
id, title, artist, album, cover_url, file_url,
lyrics (json array of {time, text}), duration, order

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🔐 AUTH — Laravel Built-in
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

- Route: /admin/login (Laravel Auth)
- After login → /admin/dashboard
- Admin dashboard: sidebar nav with CRUD for each section
- Each CRUD form uses Blade + Tailwind (shadcn-style components)
- File uploads → Laravel Storage (local disk via Laragon)
- Middleware: auth on all /admin/\* routes

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📁 LARAVEL PROJECT STRUCTURE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
/app/Http/Controllers/
HomeController.php ← renders main page with all data
Admin/DashboardController.php
Admin/ProfileController.php
Admin/SkillController.php
Admin/CareerController.php
Admin/ActivityController.php
Admin/PortfolioController.php
Admin/SongController.php
Api/GitHubController.php ← fetches from GitHub API via MCP

/app/Console/Commands/
FetchGitHubStats.php ← daily scheduler

/resources/views/
layouts/app.blade.php ← public layout (with GSAP CDN)
layouts/admin.blade.php
pages/home.blade.php ← all sections
admin/dashboard.blade.php
admin/partials/
\*.blade.php per section

/resources/js/
app.js ← GSAP init + all animations
player.js ← music player + Web Audio API
theme.js ← theme switcher
marquee.js ← skill marquee GSAP
github-heatmap.js ← heatmap renderer

/routes/
web.php ← public + admin routes
api.php ← /api/github endpoint

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🌐 ROUTES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Public:
GET / → home (all sections)
GET /api/github/stats → JSON heatmap data
GET /api/github/repos → JSON latest repos

Admin (auth middleware):
GET /admin/login
POST /admin/login
GET /admin/dashboard
GET|POST|PUT|DELETE /admin/{section}/{id?}
POST /admin/upload

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🔧 GSAP ANIMATION SUMMARY
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Load GSAP from CDN:
gsap.min.js + ScrollTrigger + TextPlugin + MotionPathPlugin

Animations mapped to sections:
NAVBAR → GSAP timeline stagger fade-in on load
HERO → TextPlugin typewriter, stagger heading, floating particles
MARQUEE → gsap.to() infinite x scroll, pauseTween on hover
CAREER → ScrollTrigger: line draw, card slide alternating L/R
ACTIVITY → ScrollTrigger: featured card scale, row stagger
PORTFOLIO → ScrollTrigger stagger, hover spotlight opacity,
GSAP brightness filter on hover
GITHUB → ScrollTrigger counter animation for stats numbers,
repo cards stagger from right
MUSIC TILES → hover scale + glow GSAP
PLAYER → GSAP slide-up open, slide-down close
ISLAND → GSAP expand/collapse timeline on hover
THEME TOGGLE → GSAP colorize transition (bg, text, accents)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🌍 GLOBAL REQUIREMENTS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

- Fully responsive (mobile-first, breakpoints: sm/md/lg/xl)
- Custom scrollbar:
  DARK → thin, neon green track
  LIGHT → thin, emerald track
- All data dynamic from PostgreSQL via Laravel Eloquent
- SEO: dynamic meta tags from profiles table
- Footer:
  DARK → "[Name]\_OS · 2026 · SYSTEM ONLINE" in mono
  LIGHT → "[Name] · 2026 · Built with precision ☕" in sans
- Vite for asset bundling (npm run dev / build)
- php artisan schedule:run → FetchGitHubStats daily
