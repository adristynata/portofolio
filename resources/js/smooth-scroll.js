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

    // Initialize Lenis with weighted momentum
    lenisInstance = new Lenis({
        duration: 1.25,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // Exponential luxury easeOut
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 0.95,
        touchMultiplier: 1.4,
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
    const navbar = document.querySelector('nav');
    const backToTopBtn = document.getElementById('back-to-top-btn');
    const heroScrollIndicator = document.getElementById('hero-scroll-indicator');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    const sections = Array.from(document.querySelectorAll('section[id]'));
    const parallaxLayers = document.querySelectorAll('[data-parallax-speed]');

    // Scroll event listener via Lenis
    lenisInstance.on('scroll', (e) => {
        const scrollY = e.scroll;
        const maxScroll = e.limit || (document.documentElement.scrollHeight - window.innerHeight);

        // 1. Top Glowing Progress Bar
        if (progressBar && maxScroll > 0) {
            const progress = Math.min(1, Math.max(0, scrollY / maxScroll));
            progressBar.style.transform = `scaleX(${progress})`;
        }

        // 2. Navbar Glass Elevation
        if (navbar) {
            if (scrollY > 20) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }
        }

        // 3. Back to Top Button Visibility
        if (backToTopBtn) {
            if (scrollY > 380) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        }

        // 4. Hero Scroll Indicator Fade Out
        if (heroScrollIndicator) {
            if (scrollY > 40) {
                heroScrollIndicator.style.opacity = '0';
                heroScrollIndicator.style.pointerEvents = 'none';
            } else {
                heroScrollIndicator.style.opacity = '1';
                heroScrollIndicator.style.pointerEvents = 'auto';
            }
        }

        // 5. Subtle Parallax on Hero Orbs & Decorative Layers
        if (parallaxLayers.length > 0 && scrollY < window.innerHeight * 1.5) {
            parallaxLayers.forEach((el) => {
                const speed = parseFloat(el.getAttribute('data-parallax-speed') || '0.15');
                const yOffset = scrollY * speed;
                el.style.transform = `translate3d(0, ${yOffset}px, 0)`;
            });
        }

        // 6. Active Scrollspy
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
            const mobileMenu = document.getElementById('menu') || document.getElementById('mobile-menu');
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }

            lenisInstance.scrollTo(target, {
                offset: -75,
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
    const navbar = document.querySelector('nav');
    const backToTopBtn = document.getElementById('back-to-top-btn');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    const sections = Array.from(document.querySelectorAll('section[id]'));

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;

        if (progressBar && maxScroll > 0) {
            progressBar.style.transform = `scaleX(${Math.min(1, Math.max(0, scrollY / maxScroll))})`;
        }

        if (navbar) {
            navbar.classList.toggle('nav-scrolled', scrollY > 20);
        }

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
