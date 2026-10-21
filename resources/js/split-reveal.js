/**
 * SPLIT REVEAL HERO & ABOUT SCROLL ANIMATION (BOON GLOBAL STYLE)
 * Stack: GSAP + ScrollTrigger + Lenis
 * Features:
 * - Layout Awal:
 *   - Sisi Kiri: "Adristy" + Deskripsi Bio
 *   - Sisi Kanan: "Akiko Yukinata" + Meta Info
 *   - Tengah: Foto Cutout Adristy (utuh, transparan, z-20 di depan teks)
 * - Saat Scroll:
 *   - Teks Sisi Kiri meluncur ke KIRI (<-) dari balik foto
 *   - Teks Sisi Kanan meluncur ke KANAN (->) dari balik foto
 *   - Foto STAY di TENGAH (tidak kebelah, tidak ikut geser horizontal)
 *   - About Section terungkap dari celah di belakangnya
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
        gsap.set('.hero-side-left', { opacity: 1, x: 0 });
        gsap.set('.hero-side-right', { opacity: 1, x: 0 });
        gsap.set('.hero-stay-photo', { opacity: 1, scale: 1 });
        gsap.set('.about-reveal-item', { opacity: 1, y: 0 });
        return;
    }

    // 2. Responsive Scroll Timeline dengan gsap.matchMedia()
    const mm = gsap.matchMedia();

    // === DESKTOP (>= 768px): Boon Global Outward Split Typography ===
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

        // a. Sisi Kiri ("Adristy" + bio) meluncur keluar ke arah KIRI dari balik foto
        tl.to('.hero-side-left', {
            xPercent: -130,
            opacity: 0,
            duration: 1,
            ease: 'power2.inOut'
        }, 0);

        // b. Sisi Kanan ("Akiko Yukinata" + meta) meluncur keluar ke arah KANAN dari balik foto
        tl.to('.hero-side-right', {
            xPercent: 130,
            opacity: 0,
            duration: 1,
            ease: 'power2.inOut'
        }, 0);

        // c. Foto STAY di tengah (tidak kebelah, tidak geser horizontal)
        // Setelah teks terbelah keluar, foto softly crossfade ke About section
        tl.to('.hero-stay-photo', {
            opacity: 0,
            scale: 1.05,
            duration: 0.45,
            ease: 'power2.inOut'
        }, 0.55);

        // d. Layer background panggung hero memudar halus
        tl.to('.hero-stage-layer', {
            opacity: 0,
            duration: 0.4,
            ease: 'power2.in'
        }, 0.6);

        // e. About Section terungkap dari belakang dengan smooth scale & fade
        tl.fromTo('.about-reveal-stage', {
            scale: 0.92,
            opacity: 0.4,
            y: 40
        }, {
            scale: 1,
            opacity: 1,
            y: 0,
            duration: 0.9,
            ease: 'power3.out'
        }, 0.15);

        // f. Staggered fade-up untuk kartu & teks About
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

        return () => tl.kill();
    });

    // === MOBILE (< 768px): Split Sisi Kiri ke Kiri & Sisi Kanan ke Kanan ===
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

        tlMobile.to('.hero-side-left', {
            xPercent: -125,
            opacity: 0,
            duration: 1,
            ease: 'power2.inOut'
        }, 0);

        tlMobile.to('.hero-side-right', {
            xPercent: 125,
            opacity: 0,
            duration: 1,
            ease: 'power2.inOut'
        }, 0);

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

        tlMobile.fromTo('.about-reveal-stage', {
            scale: 0.94,
            opacity: 0.4,
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

        return () => tlMobile.kill();
    });
}
