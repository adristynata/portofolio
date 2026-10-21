/**
 * SPLIT REVEAL HERO & ABOUT SCROLL ANIMATION
 * Stack: GSAP + ScrollTrigger + Lenis
 * Features:
 * - Layout Awal: Nama dan Bio berada di sisi KIRI, Foto cutout berada di TENGAH (utuh & transparan)
 * - Saat Scroll ke Bawah: Teks di sisi kiri meluncur keluar, Foto stay di tengah, About section terungkap dari belakang
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
        gsap.set('.hero-left-content', { opacity: 1, x: 0 });
        gsap.set('.hero-stay-photo', { opacity: 1, scale: 1 });
        gsap.set('.about-reveal-item', { opacity: 1, y: 0 });
        return;
    }

    // 2. Responsive Scroll Timeline dengan gsap.matchMedia()
    const mm = gsap.matchMedia();

    // === DESKTOP (>= 768px): Teks Nama & Bio di Kiri Meluncur Keluar Saat Scroll ===
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

        // a. Teks di sisi kiri (Nama & Bio) meluncur keluar ke arah kiri saat scroll
        tl.to('.hero-left-content', {
            xPercent: -120,
            opacity: 0,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.05);

        // b. Foto STAY di tengah (tidak kebelah), lalu soft crossfade ke About section
        tl.to('.hero-stay-photo', {
            opacity: 0,
            scale: 1.03,
            duration: 0.45,
            ease: 'power2.inOut'
        }, 0.55);

        // c. Layer panggung hero memudar halus
        tl.to('.hero-stage-layer', {
            opacity: 0,
            duration: 0.4,
            ease: 'power2.in'
        }, 0.6);

        // d. About Section terungkap dari belakang
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

        // e. Staggered fade-up untuk kartu & teks About
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

    // === MOBILE (< 768px): Teks Meluncur ke Atas Saat Scroll ===
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

        tlMobile.to('.hero-left-content', {
            yPercent: -100,
            opacity: 0,
            duration: 1,
            ease: 'power3.inOut'
        }, 0.05);

        tlMobile.to('.hero-stay-photo', {
            opacity: 0,
            scale: 1.03,
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

        return () => tlMobile.kill();
    });
}
