/**
 * Interactive Physics Evasion & Floating Engine for Hero Tech Capsules
 * Features:
 * - Gentle organic sinusoidal idle floating motion
 * - Responsive cursor repulsion (capsules steer away from cursor on approach)
 * - Elastic spring return to floating equilibrium
 * - Hardware-accelerated 60-120fps translate3d transforms
 */
export function initHeroCapsules() {
    const hero = document.getElementById('home');
    const pills = document.querySelectorAll('.tech-capsule-pill');
    if (!hero || !pills.length) return;

    // Track mouse position
    let mouseX = -9999;
    let mouseY = -9999;
    let isMouseInside = false;

    // Capsule state data
    const capsuleStates = Array.from(pills).map((el, i) => {
        return {
            el,
            currentX: 0,
            currentY: 0,
            targetX: 0,
            targetY: 0,
            phase: (i * 1.35) % (Math.PI * 2),
            speedX: 0.0016 + (i % 3) * 0.0005,
            speedY: 0.0020 + ((i + 1) % 3) * 0.0005,
            ampX: 3.5 + (i % 3) * 2,
            ampY: 5.5 + (i % 3) * 2.5,
        };
    });

    hero.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        isMouseInside = true;
    });

    hero.addEventListener('mouseleave', () => {
        isMouseInside = false;
        mouseX = -9999;
        mouseY = -9999;
    });

    hero.addEventListener('touchmove', (e) => {
        if (e.touches && e.touches.length > 0) {
            mouseX = e.touches[0].clientX;
            mouseY = e.touches[0].clientY;
            isMouseInside = true;
        }
    }, { passive: true });

    hero.addEventListener('touchend', () => {
        isMouseInside = false;
        mouseX = -9999;
        mouseY = -9999;
    });

    function render(time) {
        const repelRadius = 140; // Detection radius in pixels
        const maxRepel = 52;     // Maximum push distance in pixels

        capsuleStates.forEach((item) => {
            let repelX = 0;
            let repelY = 0;

            if (isMouseInside) {
                const rect = item.el.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const dx = centerX - mouseX;
                const dy = centerY - mouseY;
                const dist = Math.hypot(dx, dy);

                if (dist < repelRadius && dist > 0.001) {
                    const factor = Math.pow(1 - dist / repelRadius, 1.4);
                    const force = factor * maxRepel;
                    repelX = (dx / dist) * force;
                    repelY = (dy / dist) * force;
                }
            }

            // Spring towards target repulsion
            item.targetX = repelX;
            item.targetY = repelY;
            item.currentX += (item.targetX - item.currentX) * 0.14;
            item.currentY += (item.targetY - item.currentY) * 0.14;

            // Idle organic float offset
            const idleX = Math.cos(time * item.speedX + item.phase) * item.ampX;
            const idleY = Math.sin(time * item.speedY + item.phase) * item.ampY;

            const finalX = (item.currentX + idleX).toFixed(2);
            const finalY = (item.currentY + idleY).toFixed(2);

            item.el.style.transform = `translate3d(${finalX}px, ${finalY}px, 0)`;
        });

        requestAnimationFrame(render);
    }

    requestAnimationFrame(render);
}
