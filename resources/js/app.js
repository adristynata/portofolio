import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import { initInteractiveCursor } from './cursor';
import { initButterDeck } from './butter-deck';
import { initSmoothScroll } from './smooth-scroll';
import { initScrollReveal } from './scroll-reveal';
import { init3DTilt } from './tilt-3d';
import { initHeroCapsules } from './hero-capsules';

window.Alpine = Alpine;

Alpine.start();

function initCreativeInteractions() {
    initSmoothScroll();
    initScrollReveal();
    initInteractiveCursor();
    initButterDeck();
    init3DTilt();
    initHeroCapsules();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCreativeInteractions);
} else {
    initCreativeInteractions();
}
