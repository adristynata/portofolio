/**
 * Interactive 3D Card Physics, Cursor Spotlight & Animated Stat Counters
 * Powered by requestAnimationFrame for flawless 60-120fps smoothness.
 */

export function initCardEffects() {
    initSpotlightAndTilt();
    initAnimatedCounters();
    initHeroScrollIndicator();
}

/**
 * 1. 3D Tilt Physics and Dynamic Cursor Spotlight
 */
function initSpotlightAndTilt() {
    // Only enable 3D tilt on devices with hover capability (desktop / pointer)
    const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const cards = document.querySelectorAll('.card-spotlight, .dark-glass-card, .butter-card');

    if (cards.length === 0) return;

    cards.forEach((card) => {
        let isHovered = false;
        let rafId = null;
        let mouseX = 0;
        let mouseY = 0;

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;

            // Set CSS variables for radial spotlight gradient
            card.style.setProperty('--mouse-x', `${mouseX}px`);
            card.style.setProperty('--mouse-y', `${mouseY}px`);

            if (canHover && !isHovered) {
                isHovered = true;
            }

            if (canHover) {
                if (rafId) cancelAnimationFrame(rafId);
                rafId = requestAnimationFrame(() => {
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    // Max tilt: 8 degrees for elegant luxury feel
                    const rotateX = ((mouseY - centerY) / centerY) * -7;
                    const rotateY = ((mouseX - centerX) / centerX) * 7;

                    card.style.transform = `perspective(900px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) translateY(-4px) scale3d(1.018, 1.018, 1.018)`;
                });
            }
        });

        card.addEventListener('mouseleave', () => {
            isHovered = false;
            if (rafId) cancelAnimationFrame(rafId);
            if (canHover) {
                card.style.transform = '';
            }
        });
    });
}

/**
 * 2. Animated Rolling Stat Counters on Scroll
 */
function initAnimatedCounters() {
    const counterElements = document.querySelectorAll('[data-counter-target]');
    if (counterElements.length === 0) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-counter-target'), 10) || 0;
                const suffix = el.getAttribute('data-counter-suffix') || '';
                animateValue(el, 0, target, suffix, 1600);
                obs.unobserve(el);
            }
        });
    }, {
        threshold: 0.35,
    });

    counterElements.forEach((el) => observer.observe(el));
}

function animateValue(element, start, end, suffix, duration) {
    let startTimestamp = null;

    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const elapsed = timestamp - startTimestamp;
        const progress = Math.min(elapsed / duration, 1);
        
        // Luxury cubic easeOut curve
        const easeProgress = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(easeProgress * (end - start) + start);

        element.textContent = `${current}${suffix}`;

        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            element.textContent = `${end}${suffix}`;
        }
    };

    requestAnimationFrame(step);
}

/**
 * 3. Hero Scroll Indicator Click & Auto-fade
 */
function initHeroScrollIndicator() {
    const indicator = document.getElementById('hero-scroll-indicator');
    if (!indicator) return;

    // Click indicator to glide to about section
    indicator.addEventListener('click', () => {
        const aboutSection = document.getElementById('about');
        if (aboutSection) {
            if (window.__lenis) {
                window.__lenis.scrollTo(aboutSection, { offset: -70, duration: 1.2 });
            } else {
                aboutSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
}
