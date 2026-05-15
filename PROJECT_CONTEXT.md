# 📋 PROJECT CONTEXT — ZhraanF Portfolio Website

> **Dokumen ini berfungsi sebagai PRD (Product Requirements Document)**, catatan teknis, dan tracker progress pengembangan website portofolio personal **Zahran Fikri**.
> Terakhir diperbarui: **15 Mei 2026**

---

## 1. Product Overview

### 1.1 Deskripsi Produk
Website portofolio personal satu halaman (*single-page*) yang menampilkan profil profesional, pengalaman kerja, proyek, aktivitas, dan kontribusi open-source secara interaktif. Dibangun dengan pendekatan **dual-theme** (Dark Mode futuristik + Light Mode minimalis) dan animasi premium berbasis GSAP.

### 1.2 Tujuan
| Tujuan | Detail |
|--------|--------|
| **Melamar Kerja** | Menjadi media presentasi digital utama saat melamar posisi di bidang Data Science, AI/ML, dan Software Engineering |
| **Showcase Personal** | Menampilkan portofolio proyek, sertifikasi, dan pencapaian secara profesional dan interaktif |

### 1.3 Target Audiens
- **HRD / Recruiter** — Menilai profil kandidat secara cepat melalui tampilan visual yang profesional
- **Technical Recruiter** — Mengevaluasi skill stack, kontribusi GitHub, dan kualitas proyek secara mendalam
- **Hiring Manager** — Melihat detail pengalaman kerja dan pencapaian yang relevan

### 1.4 Unique Selling Points
- Dual theme (Dark/Light) dengan transisi GSAP yang smooth
- Custom cursor interaktif dengan efek trail dan perubahan warna kontekstual
- Career section dengan gallery lightbox, multi-role timeline (LinkedIn-style), dan GSAP toggle expand/collapse
- Portfolio dengan efek "Art Gallery Wall" — dual spotlight on hover
- GitHub Dashboard dengan commit heatmap dan repo list real-time
- Admin panel terintegrasi untuk manajemen konten dinamis

---

## 2. Tech Stack

| Layer | Teknologi | Catatan |
|-------|-----------|---------|
| **Backend/Framework** | Laravel 11 | Routing, Blade templating, Eloquent ORM, Auth |
| **Frontend** | HTML5 + Vanilla CSS3 + ES6 JavaScript | Tidak menggunakan framework JS (React/Vue) |
| **Animasi** | GSAP 3 (ScrollTrigger, TextPlugin) | Semua animasi utama wajib menggunakan GSAP |
| **Database** | SQLite (development) / PostgreSQL (production) | Eloquent ORM, migrasi Laravel |
| **Auth** | Laravel built-in + Google OAuth (Socialite) | Single admin login |
| **Asset Bundler** | Vite | `npm run dev` / `npm run build` |
| **Icons** | Lucide (SVG inline) + Devicons CDN | Tech stack logos via CDN |
| **Fonts** | Dark: Share Tech Mono + Rajdhani / Light: DM Sans + Inter | Google Fonts |

---

## 3. Design System

### 3.1 Color Tokens

**Dark Mode — "Futuristic Glass"**
```
--bg-primary:     #0A0A0A
--bg-secondary:   #111111
--bg-glass:       rgba(255,255,255,0.04)
--border-glass:   rgba(255,255,255,0.08)
--accent:         #00FF85  (neon green)
--accent-dim:     #00CC6A
--text-primary:   #FFFFFF
--text-muted:     #888888
```

**Light Mode — "Minimalist Emerald"**
```
--bg-primary:     #FFFFFF
--bg-secondary:   #F5F5F5
--border:         #E5E5E5
--accent:         #10B981  (emerald green)
--accent-dark:    #059669
--text-primary:   #0A0A0A
--text-muted:     #6B7280
```

### 3.2 Theme Switching
- Toggle via Sun ☀ / Moon ☾ icon di header
- Transisi smooth 0.4s menggunakan `cubic-bezier(0.4, 0, 0.2, 1)`
- Preferensi disimpan di `localStorage`
- Background pattern: Dark → dot grid (radial-gradient), Light → clean white

---

## 4. Arsitektur & Struktur File

### 4.1 Pola MVC (Monolithic Laravel)
```
app/
├── Http/Controllers/
│   ├── HomeController.php          ← Render halaman utama + semua data
│   └── AdminController.php         ← CRUD semua section + Google OAuth
├── Http/Middleware/
│   └── AdminAuth.php               ← Proteksi route admin
└── Models/
    ├── Profile.php
    ├── Skill.php
    ├── CareerEntry.php
    ├── Activity.php
    ├── Portfolio.php
    └── User.php

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php           ← Layout publik (GSAP CDN, meta tags)
│   ├── pages/
│   │   └── home.blade.php          ← Semua section dalam satu file (920 baris)
│   └── admin/
│       ├── login.blade.php
│       ├── profile.blade.php       ← CRUD Profile + Skills
│       ├── career.blade.php        ← CRUD Career Entries
│       └── activities.blade.php    ← CRUD Activities
├── js/
│   ├── app.js                      ← Logika utama: cursor, GSAP, lightbox, modals (~66KB)
│   ├── theme.js                    ← Theme switcher logic
│   ├── marquee.js                  ← Skills marquee GSAP
│   └── bootstrap.js                ← Axios setup
└── css/
    └── app.css                     ← Seluruh styling (~89KB, 4100+ baris)
```

### 4.2 Database Schema

| Tabel | Kolom Utama | Status |
|-------|-------------|--------|
| `profiles` | name, taglines (JSON), bio, photo_url, cv_url, social_links (JSON) | ✅ Aktif |
| `skills` | name, logo_url, category, row_number, order | ✅ Aktif |
| `career_entries` | company, logo_url, position, type, start_date, end_date, achievements (JSON), media_urls (JSON), location, description, skills (JSON), relevance_project_*, parent_id | ✅ Aktif |
| `activities` | title, description, category, thumbnail_url, published_at, link_url | ✅ Aktif |
| `portfolios` | title, description, thumbnail_url, tags (JSON), github_url, demo_url, type (project/certification), issuer, issued_date, cert_url, is_featured | ✅ Aktif |
| `users` | name, email, google_id, avatar | ✅ Aktif |
| `github_stats` | date, commit_count, fetched_at | ❌ Belum dibuat |
| `songs` | title, artist, album, cover_url, file_url, lyrics (JSON), duration, order | ❌ Belum dibuat |

### 4.3 Routing

**Public:**
| Method | Route | Controller | Deskripsi |
|--------|-------|------------|-----------|
| GET | `/` | `HomeController@index` | Halaman utama (semua section) |

**Admin (dilindungi middleware `AdminAuth`):**
| Method | Route | Deskripsi |
|--------|-------|-----------|
| GET | `/admin/login` | Login page (Google OAuth) |
| GET | `/admin/profile` | Manage Profile + Skills |
| GET | `/admin/career` | Manage Career Entries |
| GET | `/admin/activities` | Manage Activities |
| POST/PUT/DELETE | `/admin/*` | CRUD operations |

---

## 5. Section Breakdown & Progress

### Status Legend
- ✅ **Selesai** — Fitur lengkap, styling & animasi final
- 🟡 **Template Ada** — Blade/HTML sudah ada, konten belum diisi atau perlu polish
- 🔴 **Belum Dibuat** — Belum ada implementasi
- 💤 **Ditangguhkan** — Sengaja ditunda, scope belum jelas

---

### Section 0: Grid Hover Explore (Welcome Screen)
**Status: ✅ Selesai**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L8–L20 |
| Deskripsi | Landing screen Framer-style dengan grid interaktif yang bereaksi terhadap hover mouse |
| Animasi | Grid cells highlight mengikuti posisi cursor, CTA arrow scroll ke hero |

---

### Section 1: Hero / Profile
**Status: ✅ Selesai**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L25–L133 |
| Data Source | `profiles` table |
| Fitur | 3D tilt card, holographic foil overlay, GSAP typewriter (taglines dari DB), stat cards, skills marquee |
| Animasi | Hero heading stagger, card tilt parallax, floating particles, typewriter cycling |
| Sub-section | Stat Cards (Projects, Experience, Certifications counter) |
| Sub-section | Skills Marquee (3 rows, alternating direction, pause on hover) |

---

### Section 2: About Me
**Status: ✅ Selesai**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L138–L182 |
| Deskripsi | Section profil singkat tentang Zahran — bio, keahlian, dan value |
| Animasi | ScrollTrigger fade-up, text reveal per kata |

---

### Section 3: Career Journey (Work Experience)
**Status: ✅ Selesai (paling matang)**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L187–L430 |
| Data Source | `career_entries` table (grouped by company di HomeController) |
| Fitur Utama | Multi-role timeline (LinkedIn-style), GSAP expand/collapse toggle, image gallery hover, fullscreen lightbox, career detail modal |
| Animasi | ScrollTrigger reveal, GSAP timeline toggle (expand: `back.out(1.2)`, collapse: `power2.inOut`), staggered card reveal, arrow rotation `back.out(2)` |
| Kapabilitas | Show More / Show Less (default tampil 4 card, sisanya tersembunyi), custom cursor hijau saat hover gambar, gallery grid responsif (1-4+ foto) |
| Admin | Full CRUD di `/admin/career` — upload logo, gambar, skills, relevance project |

**Refinemen terakhir:**
- Fix spacing consistency antara visible cards dan hidden cards setelah toggle expand
- Migrasi dari `autoAlpha` ke `opacity` untuk menghindari konflik `visibility` pada flex layout
- Tombol animasi smooth slide up/down dalam GSAP timeline (tidak blink)
- ScrollTrigger kill pada hidden cards untuk menghindari double-animate

---

### Section 4: Education & Awards
**Status: ✅ Selesai**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L435–L465 |
| Deskripsi | Menampilkan latar belakang pendidikan dan penghargaan akademik |
| Data | Saat ini hardcoded di Blade (Computer Engineering — Andalas University, Cum Laude Graduate) |

---

### Section 5: My Activity
**Status: 🟡 Template Ada — Menunggu Konten**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L470–L573 |
| Data Source | `activities` table |
| Fitur | Featured/Latest card (besar), horizontal scroll row (card kecil), activity detail modal |
| Animasi | ScrollTrigger, hover scale |
| Admin | CRUD di `/admin/activities` |
| Catatan | Template Blade lengkap, styling CSS sudah ada, namun **data konten belum diisi** di database. Section akan tampil kosong jika tidak ada data |

---

### Section 6: Portfolio Showcase
**Status: 🟡 Template Ada — Menunggu Konten**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L578–L709 |
| Data Source | `portfolios` table |
| Fitur | Tab switcher (Portfolio / Certification), Art Gallery Wall style cards, dual spotlight hover, featured badge |
| Animasi | Tab indicator slide (GSAP), spotlight fade-in, brightness filter on hover |
| Admin | ❌ Halaman admin CRUD belum dibuat |
| Catatan | Template Blade & CSS lengkap termasuk certification variant, namun **data belum diisi** dan **admin page belum ada** |

---

### Section 7: GitHub Dashboard
**Status: 🟡 Template Ada — Perlu Integrasi API**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L714–L783 |
| Fitur | Profile card (avatar, stats), latest repo list, commit activity heatmap |
| Data Source | GitHub REST API (fetched via JS di client-side) |
| Status Integrasi | JS fetch ke GitHub API sudah berjalan (profile, repos, heatmap render) |
| Catatan | Heatmap calendar sudah diimplementasikan dengan native calendar timeline. Data di-fetch langsung dari GitHub API, **belum ada caching server-side** (`github_stats` table belum dibuat) |

---

### Section 8: Music / Favorite Songs
**Status: 💤 Ditangguhkan**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L789–L855 |
| Keputusan | **Section ini akan di-hide (comment out)** dari tampilan website karena konsep belum matang |
| Fitur Tersedia | Grid cover art (hardcoded), Spotify embed iframe, music player overlay modal |
| Rencana | Akan dikembangkan ulang nantinya dengan konsep yang lebih jelas. Data `songs` table dan admin CRUD belum dibuat |

---

### Section 9: Contact
**Status: 🟡 Template Ada — Perlu Backend**

| Aspek | Detail |
|-------|--------|
| File | `home.blade.php` L860–L895 |
| Fitur | Contact form (Name, Email, Subject, Message) |
| Backend | ❌ Form submission handler belum ada (tidak ada route POST untuk contact) |
| Catatan | Frontend form lengkap dengan styling, namun **submit belum berfungsi**. Opsi: integrasi dengan mail service (SMTP/Mailgun) atau redirect ke mailto: |

---

### Komponen Global
**Status: ✅ Selesai**

| Komponen | Detail |
|----------|--------|
| **Navigation** | Sticky header, blur backdrop, GSAP staggered link fade-in, mobile hamburger menu |
| **Custom Cursor** | Dot + ring + trail, perubahan warna kontekstual (hijau saat hover gambar), hidden saat mobile |
| **Theme Toggle** | Dark/Light switch dengan transisi GSAP, preferensi di localStorage |
| **Scroll Reveal** | `[data-scroll-reveal]` attribute — GSAP fade-up pada semua section |
| **Text Reveal** | `[data-text-reveal]` — Word-by-word reveal animasi pada heading |
| **Footer** | Navigation links, copyright text |
| **Image Lightbox** | Fullscreen image viewer dengan navigasi arrow + keyboard support |
| **SEO** | Dynamic meta tags dari `profiles` table |

---

## 6. Admin Dashboard

### Status CRUD per Section

| Section | Admin Page | Store | Update | Delete | Status |
|---------|-----------|-------|--------|--------|--------|
| Profile | `/admin/profile` | ✅ | ✅ | — | ✅ Lengkap |
| Skills | `/admin/profile` (tab) | ✅ | ✅ | ✅ | ✅ Lengkap |
| Career | `/admin/career` | ✅ | ✅ | ✅ | ✅ Lengkap |
| Activities | `/admin/activities` | ✅ | ✅ | ✅ | ✅ Lengkap |
| Portfolio | — | — | — | — | ❌ Belum dibuat |
| Songs | — | — | — | — | ❌ Belum dibuat (ditangguhkan) |
| GitHub Stats | — | — | — | — | ❌ Belum dibuat |

### Autentikasi
- Login via **Google OAuth** (Laravel Socialite)
- Middleware `AdminAuth` melindungi semua route `/admin/*`
- Hanya email tertentu yang diizinkan (whitelist di controller)

---

## 7. Deployment Plan

### 7.1 Strategi Dual-Deployment

| Environment | Platform | Tipe | Database | Tujuan |
|-------------|----------|------|----------|--------|
| **Production (Static)** | Vercel | Static export | — | Showcase cepat, SEO optimal, zero downtime |
| **Production (Dynamic)** | VPS | Full Laravel | PostgreSQL | Fitur lengkap dengan admin dashboard & database |

### 7.2 Domain
- Domain `.my.id` sudah tersedia
- Akan dikonfigurasi untuk mengarah ke VPS (versi dynamic)

### 7.3 Environment Variables (Production)
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=pgsql
DB_HOST=<vps-ip>
DB_DATABASE=portfolio_db
DB_USERNAME=postgres
DB_PASSWORD=<secure-password>
```

---

## 8. Backlog — Fitur yang Akan Dikerjakan

Urutan prioritas pengerjaan berdasarkan dampak terhadap tujuan utama (melamar kerja):

### 🔴 Prioritas Tinggi (Wajib sebelum deploy)
- [ ] **Isi konten Portfolio** — Tambahkan data proyek dan sertifikasi ke database
- [ ] **Buat admin CRUD Portfolio** — Halaman `/admin/portfolio` untuk manage portfolio entries
- [ ] **Implementasi Contact form backend** — Handler POST untuk mengirim email atau menyimpan pesan
- [ ] **Comment out section Music** — Sembunyikan dari tampilan publik hingga konsep matang
- [ ] **Konversi Education data ke database** — Pindahkan dari hardcoded Blade ke tabel dinamis

### 🟡 Prioritas Sedang (Nice to have sebelum deploy)
- [ ] **Isi konten Activity** — Tambahkan data bootcamp, kompetisi, dll ke database
- [ ] **GitHub Stats caching** — Buat `github_stats` migration + scheduled command untuk cache harian
- [ ] **Responsive audit** — Cek semua section pada resolusi mobile (375px, 390px, 414px)
- [ ] **SEO final check** — Pastikan meta description, OG tags, dan structured data lengkap
- [ ] **Performance optimization** — Lazy loading images, optimasi CSS/JS bundle size

### 🟢 Prioritas Rendah (Post-deploy enhancement)
- [ ] **Music section redesign** — Konsep ulang dengan API Spotify atau pendekatan baru
- [ ] **Blog/Writing section** — Jika ingin menambah konten tulisan teknis
- [ ] **Accessibility (A11y)** — `aria-expanded`, `aria-label`, keyboard navigation
- [ ] **Analytics** — Integrasi Google Analytics atau Plausible
- [ ] **PWA support** — Service worker untuk offline access
- [ ] **CI/CD Pipeline** — GitHub Actions untuk auto-deploy ke VPS

---

## 9. Keputusan Teknis & Catatan Penting

### 9.1 Kenapa Tidak Pakai React/Vue?
- Portofolio ini adalah **single-page** dengan konten statis dari database
- Blade templating + vanilla JS + GSAP sudah cukup untuk semua kebutuhan interaktivitas
- Bundle size tetap ringan (~66KB JS) tanpa overhead framework SPA
- SEO lebih baik karena server-side rendering secara native

### 9.2 GSAP: `opacity` vs `autoAlpha`
- **Keputusan:** Gunakan `opacity` (bukan `autoAlpha`) untuk elemen dalam flex container
- **Alasan:** `autoAlpha` menambahkan `visibility: hidden` yang mengganggu flex gap/layout
- **Dampak:** Khususnya pada career toggle expand/collapse — kartu yang di-toggle harus menggunakan `opacity` agar spacing konsisten

### 9.3 Career Grouping Logic
- `HomeController` mengelompokkan `career_entries` berdasarkan `company` name
- Entry dengan company yang sama ditampilkan dalam satu card dengan timeline jabatan (LinkedIn-style)
- Logika ini memungkinkan multi-role display (contoh: LKJ memiliki 2 posisi: R&D Coordinator → Lab Assistant)

### 9.4 Database Development vs Production
- Development menggunakan **SQLite** untuk kemudahan setup lokal
- Production akan menggunakan **PostgreSQL** di VPS
- Pastikan semua query compatible dengan kedua database engine

---

## 10. Konten & Aset

### 10.1 Data yang Sudah Tersedia

| Konten | Format | Lokasi |
|--------|--------|--------|
| Work Experience (7 entries) | Markdown + Image paths | `CARRIER.md` + `img/` folder |
| Profile | Database seeded | `profiles` table |
| Skills (3 rows) | Database seeded | `skills` table |
| Career Entries | Database seeded | `career_entries` table |

### 10.2 Data yang Perlu Disiapkan

| Konten | Keterangan |
|--------|------------|
| **Portfolio Projects** | Screenshot, deskripsi, GitHub URL, tech tags untuk setiap proyek |
| **Sertifikasi** | Gambar sertifikat, issuer, tanggal terbit, URL verifikasi |
| **Activities** | Thumbnail, judul, deskripsi, kategori, tanggal, link |
| **CV/Resume** | File PDF terbaru untuk tombol download di hero section |

---

*Dokumen ini akan diperbarui seiring perkembangan proyek.*
