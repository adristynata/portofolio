import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import { initInteractiveCursor } from './cursor';
import { initButterDeck } from './butter-deck';
import { initSmoothScroll } from './smooth-scroll';
import { initScrollReveal } from './scroll-reveal';
import { initCardEffects } from './card-effects';

window.Alpine = Alpine;

Alpine.start();

function initCreativeInteractions() {
    initSmoothScroll();
    initScrollReveal();
    initCardEffects();
    initInteractiveCursor();
    initButterDeck();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCreativeInteractions);
} else {
    initCreativeInteractions();
}
