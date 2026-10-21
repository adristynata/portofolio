/**
 * Hero Software Capsules & Cursor Avoidance Physics
 * Features:
 * - Ultra-smooth sinusoidal ambient floating (sine/cosine phase drift)
 * - Dynamic magnetic cursor avoidance: repels away when cursor approaches
 * - Smooth spring damping physics with natural deceleration and restitution
 * - High performance 60/120fps RAF loop with zero layout thrashing
 */

export function initHeroCapsules() {
    const heroSection = document.getElementById('home');
    const capsules = document.querySelectorAll('.hero-capsule');
    if (!heroSection || !capsules.length) return;

    // Capsule physical state tracking
    const items = Array.from(capsules).map((el, i) => {
        return {
            el,
            phaseX: i * 1.45,
            phaseY: i * 1.15 + 1.2,
            speedX: 0.0015 + (i % 3) * 0.0004,
            speedY: 0.0019 + (i % 2) * 0.0005,
            ampX: 4 + (i % 2) * 2.5,
            ampY: 6 + (i % 3) * 2.5,
            currentX: 0,
            currentY: 0,
            targetRepelX: 0,
            targetRepelY: 0,
        };
    });

    let mouseX = -9999;
    let mouseY = -9999;
    let isMouseActive = false;

    const onMouseMove = (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        isMouseActive = true;
    };

    const onMouseLeave = () => {
        isMouseActive = false;
        mouseX = -9999;
        mouseY = -9999;
        items.forEach(item => {
            item.targetRepelX = 0;
            item.targetRepelY = 0;
        });
    };

    window.addEventListener('mousemove', onMouseMove, { passive: true });
    document.addEventListener('mouseleave', onMouseLeave, { passive: true });

    const repelRadius = 150; // Detection radius in px
    const maxRepelDist = 90; // Maximum push distance in px

    let animationFrameId = null;

    function render(time) {
        items.forEach(item => {
            // 1. Gentle ambient sinusoidal floating
            const floatX = Math.sin(time * item.speedX + item.phaseX) * item.ampX;
            const floatY = Math.cos(time * item.speedY + item.phaseY) * item.ampY;

            // 2. Cursor avoidance calculation
            if (isMouseActive && mouseX > -100 && mouseY > -100) {
                const rect = item.el.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const dx = centerX - mouseX;
                const dy = centerY - mouseY;
                const dist = Math.hypot(dx, dy);

                if (dist < repelRadius && dist > 0.001) {
                    // Non-linear power repulsion: smoothly pushes harder when closer
                    const strength = Math.pow(1 - (dist / repelRadius), 1.35) * maxRepelDist;
                    const angle = Math.atan2(dy, dx);
                    item.targetRepelX = Math.cos(angle) * strength;
                    item.targetRepelY = Math.sin(angle) * strength;
                } else {
                    item.targetRepelX = 0;
                    item.targetRepelY = 0;
                }
            } else {
                item.targetRepelX = 0;
                item.targetRepelY = 0;
            }

            // 3. Smooth spring damping lerp back to resting position
            item.currentX += (item.targetRepelX - item.currentX) * 0.12;
            item.currentY += (item.targetRepelY - item.currentY) * 0.12;

            // 4. Combine ambient drift + cursor avoidance
            const totalX = floatX + item.currentX;
            const totalY = floatY + item.currentY;

            item.el.style.transform = `translate3d(${totalX.toFixed(2)}px, ${totalY.toFixed(2)}px, 0)`;
        });

        animationFrameId = requestAnimationFrame(render);
    }

    animationFrameId = requestAnimationFrame(render);
}
