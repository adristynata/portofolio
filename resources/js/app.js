import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import { initInteractiveCursor } from './cursor';
import { initButterDeck } from './butter-deck';

window.Alpine = Alpine;

Alpine.start();

function initCreativeInteractions() {
    initInteractiveCursor();
    initButterDeck();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCreativeInteractions);
} else {
    initCreativeInteractions();
}
