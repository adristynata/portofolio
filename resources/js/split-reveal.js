/**
 * SPLIT REVEAL HERO & ABOUT SCROLL ANIMATION
 * Stack: GSAP + ScrollTrigger + Lenis
 * Features:
 * - Curtain Split: Panel Kiri (translateX 0 -> -100%) & Panel Kanan (translateX 0 -> 100%)
 * - Parallax Words: "Adristy" slides left (-35%), "Akiko" slides right (35%)
 * - Center Cutout Photo: scale 1 -> 1.08 with smooth fadeout near transition end
 * - About Section Reveal: scale 0.92 -> 1, opacity 0.6 -> 1, translateY 40px -> 0
 * - Staggered fade-up for inner About elements (.about-reveal-item)
 * - Initial Page-Load: Mask reveal for split words from behind overflow:hidden
 * - Responsive: Horizontal curtain split on desktop, vertical curtain split on mobile
 * - Accessibility: prefers-reduced-motion respected
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initSplitRevealHero() {
    const stage = document.querySelector('.hero-pinned-stage');
    if (!stage) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Accessibility: prefers-reduced-motion fallback
    if (prefersReducedMotion) {
        gsap.set('.about-reveal-stage', { scale: 1, opacity: 1, y: 0 });
        gsap.set('.hero-word-reveal', { y: '0%' });
        gsap.set('.hero-split-photo', { opacity: 1, scale: 1 });
        gsap.set('.hero-split-desc', { opacity: 1, y: 0 });
        gsap.set('.about-reveal-item', { opacity: 1, y: 0 });
        return;
    }

    // 2. Initial Page-Load Reveal Animation (Mask Entrance)
    const loadTl = gsap.timeline({ defaults: { ease: 'power4.out' } });

    loadTl.to('.hero-word-reveal', {
        y: '0%',
        duration: 1.0,
        stagger: 0.1,
        delay: 0.15,
        clearProps: 'transform' // Restore clean transform state for subsequent scroll parallax
    })
    .fromTo('.hero-split-photo', {
        scale: 0.94,
        opacity: 0,
        y: 20
    }, {
        scale: 1,
        opacity: 1,
        y: 0,
        duration: 1.2,
        ease: 'power3.out'
    }, '-=0.8')
    .fromTo('.hero-split-desc', {
        opacity: 0,
        y: 18
    }, {
        opacity: 1,
        y: 0,
        duration: 0.9,
        ease: 'power3.out'
    }, '-=0.7');

    // 3. Responsive Split Scroll Animation using gsap.matchMedia()
    const mm = gsap.matchMedia();

    // === DESKTOP (>= 768px): Horizontal Curtain Split ===
    mm.add('(min-width: 768px)', () => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.hero-pinned-stage',
                start: 'top top',
                end: '+=150%',
                scrub: 1,
                pin: true,
                anticipatePin: 1,
                invalidateOnRefresh: true,
            }
        });

        // a. Subtitle fades out early
        tl.to('.hero-split-desc', {
            opacity: 0,
            y: -25,
            duration: 0.25,
            ease: 'power2.in'
        }, 0);

        // b. Left & Right curtain panels slide horizontally outward
        tl.to('.split-panel--left', {
            xPercent: -100,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        tl.to('.split-panel--right', {
            xPercent: 100,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        // c. Parallax offset on split words ("Adristy" & "Akiko")
        tl.to('.split-panel--left .hero-word-left', {
            xPercent: -35,
            duration: 1,
            ease: 'power2.inOut'
        }, 0.08);

        tl.to('.split-panel--right .hero-word-right', {
            xPercent: 35,
            duration: 1,
            ease: 'power2.inOut'
        }, 0.08);

        // d. Cutout Photo: scale 1 -> 1.08 and fade out near end
        tl.to('.hero-split-photo', {
            scale: 1.08,
            duration: 0.7,
            ease: 'power2.out'
        }, 0.08);

        tl.to('.hero-split-photo', {
            opacity: 0,
            duration: 0.35,
            ease: 'power2.in'
        }, 0.65);

        // e. About Section emerges from behind
        tl.fromTo('.about-reveal-stage', {
            scale: 0.92,
            opacity: 0.6,
            y: 40
        }, {
            scale: 1,
            opacity: 1,
            y: 0,
            duration: 0.9,
            ease: 'power3.out'
        }, 0.15);

        // f. Staggered fade-up for inner About elements
        tl.fromTo('.about-reveal-item', {
            opacity: 0,
            y: 28
        }, {
            opacity: 1,
            y: 0,
            stagger: 0.06,
            duration: 0.6,
            ease: 'power2.out'
        }, 0.35);

        return () => {
            tl.kill();
        };
    });

    // === MOBILE (< 768px): Vertical Curtain Split ===
    mm.add('(max-width: 767px)', () => {
        const tlMobile = gsap.timeline({
            scrollTrigger: {
                trigger: '.hero-pinned-stage',
                start: 'top top',
                end: '+=130%',
                scrub: 1,
                pin: true,
                anticipatePin: 1,
                invalidateOnRefresh: true,
            }
        });

        // a. Subtitle fades out early
        tlMobile.to('.hero-split-desc', {
            opacity: 0,
            y: -15,
            duration: 0.25,
            ease: 'power2.in'
        }, 0);

        // b. Top & Bottom curtain panels slide vertically outward
        tlMobile.to('.split-panel--left', {
            yPercent: -100,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        tlMobile.to('.split-panel--right', {
            yPercent: 100,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        // c. Cutout Photo scale and fade
        tlMobile.to('.hero-split-photo', {
            scale: 1.08,
            opacity: 0,
            duration: 0.8,
            ease: 'power2.inOut'
        }, 0.08);

        // d. About Section emerges from behind
        tlMobile.fromTo('.about-reveal-stage', {
            scale: 0.94,
            opacity: 0.6,
            y: 30
        }, {
            scale: 1,
            opacity: 1,
            y: 0,
            duration: 0.9,
            ease: 'power3.out'
        }, 0.15);

        tlMobile.fromTo('.about-reveal-item', {
            opacity: 0,
            y: 18
        }, {
            opacity: 1,
            y: 0,
            stagger: 0.05,
            duration: 0.6,
            ease: 'power2.out'
        }, 0.35);

        return () => {
            tlMobile.kill();
        };
    });
}
