/**
 * SPLIT REVEAL HERO & ABOUT SCROLL ANIMATION
 * Stack: GSAP + ScrollTrigger + Lenis
 * Features:
 * - HANYA teks nama yang terbelah ke samping: "Adristy" ke kiri (-125%) & "Akiko" ke kanan (+125%)
 * - Foto Adristy STAY di tengah, tidak ikut terbelah, dengan background transparan (cutout) murni
 * - About Section Reveal: scale 0.92 -> 1, opacity 0.5 -> 1, translateY 40px -> 0
 * - Staggered fade-up untuk isi konten About (.about-reveal-item)
 * - Initial Page-Load: Mask reveal untuk teks nama dari balik overflow:hidden
 * - Responsive: Teks terbelah horizontal pada desktop, vertikal pada mobile
 * - Aksesibilitas: prefers-reduced-motion dihormati
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initSplitRevealHero() {
    const stage = document.querySelector('.hero-pinned-stage');
    if (!stage) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Aksesibilitas: prefers-reduced-motion fallback
    if (prefersReducedMotion) {
        gsap.set('.about-reveal-stage', { scale: 1, opacity: 1, y: 0 });
        gsap.set('.hero-word-reveal', { y: '0%' });
        gsap.set('.hero-stay-photo', { opacity: 1, scale: 1 });
        gsap.set('.hero-split-desc', { opacity: 1, y: 0 });
        gsap.set('.about-reveal-item', { opacity: 1, y: 0 });
        return;
    }

    // 2. Animasi Awal Page-Load (Mask Entrance)
    const loadTl = gsap.timeline({ defaults: { ease: 'power4.out' } });

    loadTl.to('.hero-word-reveal', {
        y: '0%',
        duration: 1.0,
        stagger: 0.1,
        delay: 0.15,
        clearProps: 'transform' // Bersihkan inline transform untuk scroll parallax
    })
    .fromTo('.hero-stay-photo', {
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

    // === DESKTOP (>= 768px): Teks Terbelah Horizontal (Kiri & Kanan) ===
    mm.add('(min-width: 768px)', () => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.hero-pinned-stage',
                start: 'top top',
                end: '+=140%',
                scrub: 1,
                pin: true,
                anticipatePin: 1,
                invalidateOnRefresh: true,
            }
        });

        // a. Subjudul fade out lebih awal
        tl.to('.hero-split-desc', {
            opacity: 0,
            y: -25,
            duration: 0.25,
            ease: 'power2.in'
        }, 0);

        // b. HANYA TEKS YANG TERBELAH: Kata "Adristy" bergeser ke kiri offscreen
        tl.to('.hero-split-text-left', {
            xPercent: -125,
            opacity: 0,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        // c. HANYA TEKS YANG TERBELAH: Kata "Akiko" bergeser ke kanan offscreen
        tl.to('.hero-split-text-right', {
            xPercent: 125,
            opacity: 0,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        // d. Foto STAY di tengah (tidak kebelah), lalu soft crossfade saat About section muncul
        tl.to('.hero-stay-photo', {
            opacity: 0,
            scale: 1.04,
            duration: 0.45,
            ease: 'power2.inOut'
        }, 0.55);

        // e. Layer panggung hero fade out halus
        tl.to('.hero-stage-layer', {
            opacity: 0,
            duration: 0.4,
            ease: 'power2.in'
        }, 0.6);

        // f. About Section muncul dari belakang celah
        tl.fromTo('.about-reveal-stage', {
            scale: 0.92,
            opacity: 0.5,
            y: 40
        }, {
            scale: 1,
            opacity: 1,
            y: 0,
            duration: 0.9,
            ease: 'power3.out'
        }, 0.15);

        // g. Staggered fade-up untuk isi konten About
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

    // === MOBILE (< 768px): Teks Terbelah Vertikal (Atas & Bawah) ===
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

        // a. Subjudul fade out lebih awal
        tlMobile.to('.hero-split-desc', {
            opacity: 0,
            y: -15,
            duration: 0.25,
            ease: 'power2.in'
        }, 0);

        // b. Kata "Adristy" bergeser ke atas
        tlMobile.to('.hero-split-text-left', {
            yPercent: -125,
            opacity: 0,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        // c. Kata "Akiko" bergeser ke bawah
        tlMobile.to('.hero-split-text-right', {
            yPercent: 125,
            opacity: 0,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.08);

        // d. Foto STAY di tengah (tidak kebelah), lalu soft crossfade
        tlMobile.to('.hero-stay-photo', {
            opacity: 0,
            scale: 1.04,
            duration: 0.45,
            ease: 'power2.inOut'
        }, 0.55);

        tlMobile.to('.hero-stage-layer', {
            opacity: 0,
            duration: 0.4,
            ease: 'power2.in'
        }, 0.6);

        // e. About Section muncul dari belakang
        tlMobile.fromTo('.about-reveal-stage', {
            scale: 0.94,
            opacity: 0.5,
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
