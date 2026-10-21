/**
 * High-End Luxury Inertia Smooth Scrolling powered by Lenis
 * Features:
 * - Silky 60-120fps physics-based lerp momentum
 * - Glowing top reading progress bar with sub-pixel interpolation
 * - Dynamic glassmorphic navbar elevation on scroll
 * - Active Scrollspy with animated pill highlight
 * - Smooth anchor navigation with custom offset
 * - Modal scroll-lock synchronization
 * - Floating glass Back-to-Top button
 */

import Lenis from 'lenis';

let lenisInstance = null;

export function getLenis() {
    return lenisInstance;
}

export function initSmoothScroll() {
    // Respect user's motion preferences
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        document.documentElement.style.scrollBehavior = 'smooth';
        initScrollUIOnly();
        return;
    }

    // Initialize Lenis with natural, responsive momentum
    lenisInstance = new Lenis({
        duration: 0.9,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // Snappy easeOut
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 1.0,
        touchMultiplier: 1.2,
        infinite: false,
    });

    window.__lenis = lenisInstance;

    // RAF Loop for silky 60-120fps execution
    function raf(time) {
        lenisInstance.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // Elements
    const progressBar = document.getElementById('scroll-progress-bar');
    const navbar = document.getElementById('siteNav');
    const backToTopBtn = document.getElementById('back-to-top-btn');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    const sections = Array.from(document.querySelectorAll('section[id]'));
    const parallaxLayers = document.querySelectorAll('[data-parallax-speed]');

    // Scroll event listener via Lenis
    lenisInstance.on('scroll', (e) => {
        const scrollY = e.scroll;
        const maxScroll = e.limit || (document.documentElement.scrollHeight - window.innerHeight);

        // 1. Reading Progress Bar
        if (progressBar && maxScroll > 0) {
            const progress = Math.min(1, Math.max(0, scrollY / maxScroll));
            progressBar.style.transform = `scaleX(${progress})`;
        }

        // 2. Navbar: frosted when scrolled, hidden while scrolling down
        updateNavbar(navbar, scrollY);

        // 3. Back to Top Button Visibility
        if (backToTopBtn) {
            if (scrollY > 380) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        }

        // 4. Subtle Parallax on Hero Shapes
        if (parallaxLayers.length > 0 && scrollY < window.innerHeight * 1.5) {
            parallaxLayers.forEach((el) => {
                const speed = parseFloat(el.getAttribute('data-parallax-speed') || '0.12');
                const yOffset = scrollY * speed;
                el.style.transform = `translate3d(0, ${yOffset}px, 0)`;
            });
        }

        // 5. Active Scrollspy
        updateScrollspy(scrollY, sections, navLinks);
    });

    // Handle Back to Top button click
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            lenisInstance.scrollTo(0, { duration: 1.4 });
        });
    }

    // Intercept internal anchor link clicks for ultra-smooth gliding
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href^="#"]');
        if (!link) return;

        const href = link.getAttribute('href');
        if (!href || href === '#' || href === '#!') return;

        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();

            // Close mobile menu if open
            if (typeof window.closeMobileNav === 'function') {
                window.closeMobileNav();
            }

            lenisInstance.scrollTo(target, {
                offset: -72,
                duration: 1.25,
            });
        }
    });

    // Synchronize modal scroll-lock
    observeModalState(lenisInstance);
}

/**
 * Fallback UI for reduced motion
 */
function initScrollUIOnly() {
    const progressBar = document.getElementById('scroll-progress-bar');
    const navbar = document.getElementById('siteNav');
    const backToTopBtn = document.getElementById('back-to-top-btn');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    const sections = Array.from(document.querySelectorAll('section[id]'));

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;

        if (progressBar && maxScroll > 0) {
            progressBar.style.transform = `scaleX(${Math.min(1, Math.max(0, scrollY / maxScroll))})`;
        }

        updateNavbar(navbar, scrollY);

        if (backToTopBtn) {
            backToTopBtn.classList.toggle('visible', scrollY > 380);
        }

        updateScrollspy(scrollY, sections, navLinks);
    }, { passive: true });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
}

/**
 * Navbar state: frosted background once scrolled, slides away while the user
 * scrolls down and returns as soon as they scroll up. Never hides near the top
 * of the page or while the mobile menu is open.
 */
let lastNavScrollY = 0;

function updateNavbar(navbar, scrollY) {
    if (!navbar) return;

    navbar.classList.toggle('nav-scrolled', scrollY > 20);

    const delta = scrollY - lastNavScrollY;
    if (Math.abs(delta) < 6) return; // ignore micro-jitter from inertia

    const shouldHide = delta > 0 && scrollY > 320 && !navbar.classList.contains('menu-open');
    navbar.classList.toggle('nav-hidden', shouldHide);
    lastNavScrollY = scrollY;
}

/**
 * Scrollspy Engine
 */
function updateScrollspy(scrollY, sections, navLinks) {
    if (!sections.length || !navLinks.length) return;

    const viewportAnchor = scrollY + window.innerHeight * 0.35;
    let currentId = '';

    for (let i = sections.length - 1; i >= 0; i--) {
        const section = sections[i];
        if (section.offsetTop <= viewportAnchor) {
            currentId = section.getAttribute('id');
            break;
        }
    }

    if (!currentId && sections.length > 0) {
        currentId = sections[0].getAttribute('id');
    }

    navLinks.forEach((link) => {
        const href = link.getAttribute('href');
        if (href === `#${currentId}`) {
            link.classList.add('nav-active');
        } else {
            link.classList.remove('nav-active');
        }
    });
}

/**
 * Pause Lenis when modal preview opens, resume when closed
 */
function observeModalState(lenis) {
    const modal = document.getElementById('projectModal');
    if (!modal) return;

    const observer = new MutationObserver(() => {
        const isHidden = modal.classList.contains('hidden');
        if (isHidden) {
            lenis.start();
        } else {
            lenis.stop();
        }
    });

    observer.observe(modal, { attributes: true, attributeFilter: ['class'] });
}
