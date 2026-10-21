/**
 * SPLIT REVEAL HERO & ABOUT SCROLL ANIMATION (BOON GLOBAL STYLE)
 * Stack: GSAP + ScrollTrigger + Lenis
 * Features:
 * - Layout Awal:
 *   - Baris 1: "ADRISTY" (Kiri) dan "AKIKO" (Kanan) sama rata sejajar horizontal
 *   - Baris 2: "YUKINATA" berada di tengah tepat di belakang foto
 *   - Tengah: Foto Cutout Adristy (utuh, transparan, z-20 di depan teks)
 * - Saat Scroll:
 *   - Teks "ADRISTY" meluncur ke KIRI (<-)
 *   - Teks "YUKINATA" meluncur ke KIRI ikut Adristy (<-) dari balik foto
 *   - Teks "AKIKO" meluncur ke KANAN (->)
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
        gsap.set('.hero-anim-adristy', { opacity: 1, x: 0 });
        gsap.set('.hero-anim-akiko', { opacity: 1, x: 0 });
        gsap.set('.hero-anim-yukinata', { opacity: 1, x: 0 });
        gsap.set('.hero-stay-photo', { opacity: 1, scale: 1 });
        gsap.set('.about-reveal-item', { opacity: 1, y: 0 });
        return;
    }

    // 2. Responsive Scroll Timeline dengan gsap.matchMedia()
    const mm = gsap.matchMedia();

    // === DESKTOP (>= 768px): Natural Split Scroll (Tanpa jeda/halaman kosong) ===
    mm.add('(min-width: 768px)', () => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.hero-pinned-stage',
                start: 'top top',
                end: 'bottom top',
                scrub: 0.5,
                invalidateOnRefresh: true,
            }
        });

        // a. "ADRISTY" (+ bio jika ada) meluncur ke KIRI
        tl.to('.hero-anim-adristy', {
            xPercent: -110,
            opacity: 0,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // b. "YUKINATA" (di tengah) meluncur ke KIRI ikut Adristy keluar dari balik foto!
        tl.to('.hero-anim-yukinata', {
            xPercent: -100,
            opacity: 0,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // c. "AKIKO" (+ badge info) meluncur ke KANAN
        tl.to('.hero-anim-akiko', {
            xPercent: 110,
            opacity: 0,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // d. Foto STAY di tengah, naik anggun bersama hero section
        tl.to('.hero-stay-photo', {
            yPercent: -10,
            scale: 0.98,
            opacity: 0.85,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // e. Ambient backlight memudar lembut
        tl.to('.hero-ambient-glow', {
            opacity: 0.3,
            duration: 0.8,
            ease: 'power1.in'
        }, 0);

        // Staggered fade-up untuk kartu About saat user masuk ke #about
        gsap.fromTo('.about-reveal-item', {
            opacity: 0,
            y: 35
        }, {
            scrollTrigger: {
                trigger: '#about',
                start: 'top 75%',
                toggleActions: 'play none none none',
            },
            opacity: 1,
            y: 0,
            stagger: 0.08,
            duration: 0.8,
            ease: 'power2.out',
        });

        return () => {
            tl.kill();
        };
    });

    // === MOBILE (< 768px): Natural Split Scroll (Tanpa jeda/halaman kosong) ===
    mm.add('(max-width: 767px)', () => {
        const tlMobile = gsap.timeline({
            scrollTrigger: {
                trigger: '.hero-pinned-stage',
                start: 'top top',
                end: 'bottom top',
                scrub: 0.5,
                invalidateOnRefresh: true,
            }
        });

        // a. ADRISTY meluncur ke KIRI
        tlMobile.to('.hero-anim-adristy', {
            xPercent: -100,
            opacity: 0,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // b. YUKINATA (di tengah) meluncur ke KIRI ikut Adristy
        tlMobile.to('.hero-anim-yukinata', {
            xPercent: -90,
            opacity: 0,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // c. AKIKO meluncur ke KANAN
        tlMobile.to('.hero-anim-akiko', {
            xPercent: 100,
            opacity: 0,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        // d. Foto STAY di tengah
        tlMobile.to('.hero-stay-photo', {
            yPercent: -10,
            scale: 0.98,
            opacity: 0.85,
            duration: 0.8,
            ease: 'power1.inOut'
        }, 0);

        tlMobile.to('.hero-ambient-glow', {
            opacity: 0.3,
            duration: 0.8,
            ease: 'power1.in'
        }, 0);

        gsap.fromTo('.about-reveal-item', {
            opacity: 0,
            y: 20
        }, {
            scrollTrigger: {
                trigger: '#about',
                start: 'top 80%',
                toggleActions: 'play none none none',
            },
            opacity: 1,
            y: 0,
            stagger: 0.06,
            duration: 0.7,
            ease: 'power2.out',
        });

        return () => {
            tlMobile.kill();
        };
    });
}
