/**
 * Butter.video & Noth.in inspired Fluid Interactive Cursor & Ambient Spotlight
 * High performance 60fps requestAnimationFrame with lerp easing
 */

export function initInteractiveCursor() {
    // Only activate on devices with fine pointer (mouse/trackpad), skip touch screens
    if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        return;
    }

    // Check if cursor elements already exist
    if (document.getElementById('custom-cursor-container')) {
        return;
    }

    // Create DOM structure for cursor
    const container = document.createElement('div');
    container.id = 'custom-cursor-container';
    container.innerHTML = `
        <div id="cursor-ambient-glow" class="pointer-events-none fixed inset-0 z-30 transition-opacity duration-500 opacity-0"></div>
        <div id="cursor-dot" class="pointer-events-none fixed top-0 left-0 z-[99999] -translate-x-1/2 -translate-y-1/2 rounded-full transition-transform duration-75 ease-out opacity-0"></div>
        <div id="cursor-follower" class="pointer-events-none fixed top-0 left-0 z-[99998] -translate-x-1/2 -translate-y-1/2 rounded-full transition-all duration-300 ease-out flex items-center justify-center text-[10px] font-extrabold uppercase tracking-widest text-cyan-300 opacity-0 select-none backdrop-blur-[2px]">
            <span id="cursor-label" class="opacity-0 transition-opacity duration-200"></span>
        </div>
    `;
    document.body.appendChild(container);

    const dot = document.getElementById('cursor-dot');
    const follower = document.getElementById('cursor-follower');
    const ambientGlow = document.getElementById('cursor-ambient-glow');
    const label = document.getElementById('cursor-label');

    // Coordinates & Lerp Physics
    let mouseX = -100;
    let mouseY = -100;
    let followerX = -100;
    let followerY = -100;
    let isVisible = false;
    let isClicking = false;
    let currentMode = 'default'; // 'default', 'link', 'project', 'media', 'text'

    const lerp = (start, end, factor) => start + (end - start) * factor;

    // Mouse Move Event
    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        if (!isVisible) {
            followerX = mouseX;
            followerY = mouseY;
            isVisible = true;
            dot.style.opacity = '1';
            follower.style.opacity = '1';
            ambientGlow.style.opacity = '1';
        }

        // Direct position update for the sharp center dot
        dot.style.left = `${mouseX}px`;
        dot.style.top = `${mouseY}px`;

        // Update ambient spotlight radial coordinates
        ambientGlow.style.background = `radial-gradient(650px circle at ${mouseX}px ${mouseY}px, rgba(0, 240, 255, 0.05), rgba(168, 85, 247, 0.02) 40%, transparent 75%)`;
    }, { passive: true });

    // Mouse Leave & Enter Window
    document.addEventListener('mouseleave', () => {
        isVisible = false;
        dot.style.opacity = '0';
        follower.style.opacity = '0';
        ambientGlow.style.opacity = '0';
    });

    document.addEventListener('mouseenter', () => {
        isVisible = true;
        dot.style.opacity = '1';
        follower.style.opacity = '1';
        ambientGlow.style.opacity = '1';
    });

    // Click / Mouse Down Effects
    window.addEventListener('mousedown', () => {
        isClicking = true;
        follower.classList.add('cursor-clicking');
        dot.classList.add('cursor-dot-clicking');
    });

    window.addEventListener('mouseup', () => {
        isClicking = false;
        follower.classList.remove('cursor-clicking');
        dot.classList.remove('cursor-dot-clicking');
    });

    // 60fps Animation Loop with Fluid Inertia
    function render() {
        if (isVisible) {
            // Smooth lerp (0.16 factor gives a silky butter-like drag)
            followerX = lerp(followerX, mouseX, 0.16);
            followerY = lerp(followerY, mouseY, 0.16);

            follower.style.left = `${followerX}px`;
            follower.style.top = `${followerY}px`;
        }

        requestAnimationFrame(render);
    }
    requestAnimationFrame(render);

    // Contextual Hover Handlers (Butter.video & Noth.in style)
    function updateCursorMode(mode, text = '') {
        currentMode = mode;
        follower.className = follower.className.replace(/\bcursor-mode-\S+/g, '');

        if (text) {
            label.textContent = text;
            label.style.opacity = '1';
        } else {
            label.textContent = '';
            label.style.opacity = '0';
        }

        if (mode !== 'default') {
            follower.classList.add(`cursor-mode-${mode}`);
        }
    }

    // Attach listeners with event delegation for optimum performance
    document.addEventListener('mouseover', (e) => {
        const target = e.target;

        // 1. Project cards (Butter.video style expanded preview pill)
        const projectCard = target.closest('#project .dark-glass-card, [data-img]');
        if (projectCard) {
            updateCursorMode('project', 'VIEW');
            return;
        }

        // 1b. Butter Skills Cards (Butter.video style)
        const butterCard = target.closest('.butter-card');
        if (butterCard) {
            updateCursorMode('project', 'STACK');
            return;
        }

        // 2. Certificate cards
        const certCard = target.closest('#sertifikat .dark-glass-card');
        if (certCard) {
            updateCursorMode('media', 'LIHAT');
            return;
        }

        // 3. Buttons & Links (Magnetic expansion)
        const clickable = target.closest('a, button, input[type="submit"], input[type="button"], [role="button"]');
        if (clickable) {
            updateCursorMode('link');
            return;
        }

        // 4. Headings & Hero big text (Noth.in subtle text highlight)
        const bigText = target.closest('h1, h2, .highlight-cursor-text');
        if (bigText) {
            updateCursorMode('text');
            return;
        }

        updateCursorMode('default');
    });

    // Spotlight on Dark Glass Cards
    const cards = document.querySelectorAll('.dark-glass-card');
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
