import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import { initInteractiveCursor } from './cursor';

window.Alpine = Alpine;

Alpine.start();

// Initialize Butter.video & Noth.in inspired cursor and spotlight
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initInteractiveCursor());
} else {
    initInteractiveCursor();
}
