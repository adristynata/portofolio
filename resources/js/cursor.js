/**
 * High-End Luxury Fluid Cursor inspired by Butter.video & Noth.in
 * Features:
 * - 60fps GPU translate3d with spring interpolation
 * - Velocity-based fluid squish & stretch (Jelly / Butter deformation)
 * - Frosted glass iridescent aura with light/dark adaptive theming
 * - Contextual morphing (Pill, Magnetic, Text Lens)
 * - Bulletproof desktop OS cursor suppression with instant input restoration
 * - Smooth scroll & text-entry recovery
 */

export function initInteractiveCursor() {
    // Only activate on devices with fine pointer (mouse/trackpad), never on touch
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        return;
    }

    // Remove any existing instance
    const oldContainer = document.getElementById('custom-cursor-container');
    if (oldContainer) {
        oldContainer.remove();
    }

    // Create DOM structure
    const container = document.createElement('div');
    container.id = 'custom-cursor-container';
    container.innerHTML = `
        <div id="cursor-ambient-spotlight" class="pointer-events-none fixed inset-0 z-30 transition-opacity duration-700 opacity-0"></div>
        <div id="cursor-dot" class="pointer-events-none fixed top-0 left-0 z-[99999] rounded-full opacity-0"></div>
        <div id="cursor-follower" class="pointer-events-none fixed top-0 left-0 z-[99998] rounded-full opacity-0 flex items-center justify-center"></div>
    `;
    document.body.appendChild(container);

    const dot = document.getElementById('cursor-dot');
    const follower = document.getElementById('cursor-follower');
    const spotlight = document.getElementById('cursor-ambient-spotlight');

    // Hide default OS cursor globally on desktop
    document.documentElement.classList.add('has-custom-cursor');

    // Physics & State Variables
    let mouseX = -100;
    let mouseY = -100;
    let prevMouseX = -100;
    let prevMouseY = -100;

    let followerX = -100;
    let followerY = -100;

    let velX = 0;
    let velY = 0;
    let currentAngle = 0;
    let currentScaleX = 1;
    let currentScaleY = 1;

    let isVisible = false;
    let isClicking = false;
    let isOverTextInput = false;
    let targetMode = 'default'; // 'default', 'link', 'text'

    const lerp = (a, b, n) => (1 - n) * a + n * b;

    // Mouse Movement Handler
    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        if (!isVisible) {
            followerX = mouseX;
            followerY = mouseY;
            prevMouseX = mouseX;
            prevMouseY = mouseY;
            isVisible = true;
            if (!isOverTextInput) {
                dot.style.opacity = '1';
                follower.style.opacity = '1';
            }
            spotlight.style.opacity = '1';
        }

        // 0-latency instant positioning for the center precision dot
        dot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0) translate(-50%, -50%)`;

        // Ambient spotlight glow following cursor (theme adaptive - Swiss / Sage luxury palette)
        const isLight = document.documentElement.classList.contains('light');
        if (isLight) {
            spotlight.style.background = `radial-gradient(550px circle at ${mouseX}px ${mouseY}px, rgba(117, 130, 104, 0.05), rgba(165, 182, 152, 0.025) 40%, transparent 70%)`;
        } else {
            spotlight.style.background = `radial-gradient(600px circle at ${mouseX}px ${mouseY}px, rgba(117, 130, 104, 0.06), rgba(165, 182, 152, 0.025) 40%, transparent 70%)`;
        }

        // Evaluate target under cursor
        updateTarget(e.target);
    }, { passive: true });

    // Scroll Handler: restore/update cursor state when scrolling past elements
    window.addEventListener('scroll', () => {
        if (mouseX >= 0 && mouseY >= 0) {
            const el = document.elementFromPoint(mouseX, mouseY);
            if (el) {
                updateTarget(el);
            }
        }
    }, { passive: true });

    // Window In/Out Handlers
    document.addEventListener('mouseleave', () => {
        isVisible = false;
        dot.style.opacity = '0';
        follower.style.opacity = '0';
        spotlight.style.opacity = '0';
    });

    document.addEventListener('mouseenter', () => {
        isVisible = true;
        isOverTextInput = false;
        dot.style.opacity = '1';
        follower.style.opacity = '1';
        spotlight.style.opacity = '1';
    });

    // Click Physics
    window.addEventListener('mousedown', () => {
        isClicking = true;
        follower.classList.add('is-clicking');
        dot.classList.add('is-clicking');
    });

    window.addEventListener('mouseup', () => {
        isClicking = false;
        follower.classList.remove('is-clicking');
        dot.classList.remove('is-clicking');
    });

    // 60FPS Fluid Animation Loop with Velocity Squish & Stretch (Butter signature)
    function renderLoop() {
        if (isVisible) {
            // Smooth follower position interpolation
            followerX = lerp(followerX, mouseX, 0.18);
            followerY = lerp(followerY, mouseY, 0.18);

            // Calculate instantaneous velocity
            velX = mouseX - prevMouseX;
            velY = mouseY - prevMouseY;
            prevMouseX = mouseX;
            prevMouseY = mouseY;

            const speed = Math.sqrt(velX * velX + velY * velY);

            // Calculate stretch angle & amount (jelly deformation)
            if (speed > 1.5 && targetMode === 'default') {
                const angle = Math.atan2(velY, velX);
                currentAngle = lerp(currentAngle, angle, 0.2);

                const stretch = Math.min(speed * 0.0035, 0.35);
                currentScaleX = lerp(currentScaleX, 1 + stretch, 0.2);
                currentScaleY = lerp(currentScaleY, 1 - stretch * 0.6, 0.2);
            } else {
                currentAngle = lerp(currentAngle, 0, 0.15);
                currentScaleX = lerp(currentScaleX, 1, 0.15);
                currentScaleY = lerp(currentScaleY, 1, 0.15);
            }

            // Apply GPU-accelerated fluid jelly transform
            follower.style.transform = `translate3d(${followerX}px, ${followerY}px, 0) translate(-50%, -50%) rotate(${currentAngle}rad) scale(${currentScaleX}, ${currentScaleY})`;
        }

        requestAnimationFrame(renderLoop);
    }
    requestAnimationFrame(renderLoop);

    // Contextual Mode Morphing
    function setMode(mode) {
        if (targetMode === mode) return;
        targetMode = mode;

        follower.className = 'pointer-events-none fixed top-0 left-0 z-[99998] rounded-full flex items-center justify-center';

        if (mode !== 'default') {
            follower.classList.add(`mode-${mode}`);
            dot.className = `pointer-events-none fixed top-0 left-0 z-[99999] rounded-full dot-mode-${mode}`;
        } else {
            dot.className = 'pointer-events-none fixed top-0 left-0 z-[99999] rounded-full';
        }
    }

    // Unified Target Detection (Inputs, Hover states, and Interactive elements)
    function updateTarget(target) {
        if (!target) return;

        // Check if cursor is over a text entry input / textarea
        const isTextInput = !!target.closest('input:not([type="submit"]):not([type="button"]):not([type="checkbox"]):not([type="radio"]), textarea, [contenteditable="true"]');

        if (isTextInput) {
            if (!isOverTextInput) {
                isOverTextInput = true;
                dot.style.opacity = '0';
                follower.style.opacity = '0';
            }
            return;
        }

        // When not over a text input, ensure custom cursor is restored
        if (isOverTextInput) {
            isOverTextInput = false;
            if (isVisible) {
                dot.style.opacity = '1';
                follower.style.opacity = '1';
            }
        } else if (isVisible && (dot.style.opacity === '0' || follower.style.opacity === '0')) {
            dot.style.opacity = '1';
            follower.style.opacity = '1';
        }

        // 1. Clickable Links, Buttons, Inputs, Labels
        const clickable = target.closest('a, button, input[type="submit"], input[type="button"], [role="button"], .interactive-pill, label, select');
        if (clickable) {
            setMode('link');
            return;
        }

        // 2. Headings
        const heading = target.closest('h1, h2, .invert-hover-text');
        if (heading) {
            setMode('text');
            return;
        }

        // Default normal floating droplet
        setMode('default');
    }

    // Event Delegation for Interactive Hover Elements
    document.addEventListener('mouseover', (e) => {
        updateTarget(e.target);
    });

    // Card Spotlight Highlight Effect
    const cards = document.querySelectorAll('.dark-glass-card, .butter-card');
    cards.forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--card-mouse-x', `${x}px`);
            card.style.setProperty('--card-mouse-y', `${y}px`);
        });
    });
}
