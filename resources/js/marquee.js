/**
 * Skills Marquee — Infinite GSAP horizontal scroll
 * Row 1 & 3: scroll LEFT, Row 2: scroll RIGHT
 * Pauses on hover, resumes on leave
 */
export function initMarquee() {
    if (typeof gsap === 'undefined') return;

    const rows = document.querySelectorAll('[data-marquee-row]');

    rows.forEach(row => {
        const track = row.querySelector('[data-marquee-track]');
        if (!track) return;

        const direction = row.getAttribute('data-direction'); // 'left' or 'right'
        const pills = track.querySelectorAll('.skill-pill');
        if (pills.length === 0) return;

        // Calculate total width of one set of items
        // We tripled the items in Blade, so the track has 3 copies
        const oneSetWidth = Array.from(pills).slice(0, pills.length / 3).reduce((acc, pill) => {
            return acc + pill.offsetWidth + 12; // 12px gap (0.75rem)
        }, 0);

        // Starting position for right-direction rows
        if (direction === 'right') {
            gsap.set(track, { x: -oneSetWidth });
        }

        // Create the infinite tween
        const tween = gsap.to(track, {
            x: direction === 'left' ? `-=${oneSetWidth}` : `+=${oneSetWidth}`,
            duration: direction === 'left' ? 30 : 35,
            ease: 'none',
            repeat: -1,
            modifiers: {
                x: gsap.utils.unitize(x => {
                    const val = parseFloat(x);
                    if (direction === 'left') {
                        return val % oneSetWidth;
                    } else {
                        // For right direction, wrap around
                        return ((val % oneSetWidth) + oneSetWidth) % oneSetWidth - oneSetWidth;
                    }
                })
            }
        });

        // Pause on hover
        row.addEventListener('mouseenter', () => {
            gsap.to(tween, { timeScale: 0, duration: 0.5 });
        });

        row.addEventListener('mouseleave', () => {
            gsap.to(tween, { timeScale: 1, duration: 0.5 });
        });
    });
}
