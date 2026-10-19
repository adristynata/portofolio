/**
 * Luxury 3D Scroll Reveal Engine using IntersectionObserver
 * Features:
 * - Sub-pixel hardware-accelerated 3D fluid entrances (3D perspective tilt, scale, directional yaw)
 * - Intelligent initial hero cascade detection on load
 * - Clean unobserving for peak 60-120fps scrolling performance
 * - Reduced motion support
 */

export function initScrollReveal() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealSelector = '.reveal-init, .reveal-fade, .reveal-left, .reveal-right, .reveal-scale';
    const elements = document.querySelectorAll(revealSelector);

    if (elements.length === 0) return;

    if (prefersReducedMotion) {
        elements.forEach((el) => el.classList.add('reveal-active'));
        return;
    }

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -50px 0px',
        threshold: 0.12,
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Initial check: Only animate elements genuinely in the initial hero view on load
    elements.forEach((el, idx) => {
        const rect = el.getBoundingClientRect();
        const isInInitialView = rect.top < window.innerHeight * 0.75;
        const isHeroElement = el.closest('#home') !== null;

        if (isInInitialView && isHeroElement) {
            // Cascade entrance for hero elements
            setTimeout(() => {
                el.classList.add('reveal-active');
            }, 80 + (idx * 60));
        } else {
            revealObserver.observe(el);
        }
    });
}
