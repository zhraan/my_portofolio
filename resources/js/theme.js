/**
 * Theme Switcher — Dark / Light toggle with localStorage
 * Updated for Framer-style pill switcher
 */
export function initTheme() {
    const html = document.documentElement;
    const toggle = document.getElementById('theme-toggle');
    const stored = localStorage.getItem('portfolio-theme');

    // Apply stored or default to dark
    html.setAttribute('data-theme', stored || 'dark');

    if (toggle) {
        toggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';

            // Framer-style smooth transition
            if (typeof gsap !== 'undefined') {
                // Quick flash effect
                const flash = document.createElement('div');
                flash.style.cssText = 'position:fixed;inset:0;z-index:99990;pointer-events:none;background:var(--accent);opacity:0;';
                document.body.appendChild(flash);

                gsap.to(flash, {
                    opacity: 0.06,
                    duration: 0.15,
                    ease: 'power2.in',
                    onComplete: () => {
                        html.setAttribute('data-theme', next);
                        localStorage.setItem('portfolio-theme', next);
                        gsap.to(flash, {
                            opacity: 0,
                            duration: 0.3,
                            ease: 'power2.out',
                            onComplete: () => flash.remove()
                        });
                    }
                });
            } else {
                html.setAttribute('data-theme', next);
                localStorage.setItem('portfolio-theme', next);
            }
        });
    }
}
