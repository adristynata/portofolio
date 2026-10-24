import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import { initInteractiveCursor } from './cursor';
import { initButterDeck } from './butter-deck';
import { initSmoothScroll } from './smooth-scroll';
import { initScrollReveal } from './scroll-reveal';
import { init3DTilt } from './tilt-3d';
import { initHeroCapsules } from './hero-capsules';
import { initSplitRevealHero } from './split-reveal';
import { initAAY3DMonogram } from './aay-3d';

window.Alpine = Alpine;

Alpine.start();

function initCreativeInteractions() {
    initSmoothScroll();
    initSplitRevealHero();
    initScrollReveal();
    initInteractiveCursor();
    initButterDeck();
    init3DTilt();
    initHeroCapsules();
    initAAY3DMonogram();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCreativeInteractions);
} else {
    initCreativeInteractions();
}
