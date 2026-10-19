/**
 * Luxury Scroll Reveal Engine using IntersectionObserver
 * Features:
 * - Sub-pixel hardware-accelerated fluid entrances (slide, scale, fade, directional)
 * - Intelligent initial viewport detection (instant staggered hero reveal on load)
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
        rootMargin: '0px 0px -45px 0px',
        threshold: 0.1,
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    elements.forEach((el) => {
        // If element is already within the top viewport on load, reveal with slight stagger
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight * 0.9) {
            requestAnimationFrame(() => {
                setTimeout(() => {
                    el.classList.add('reveal-active');
                }, 60);
            });
        } else {
            revealObserver.observe(el);
        }
    });
}
