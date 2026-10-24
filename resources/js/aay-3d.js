/**
 * AAY 3D INTERACTIVE MONOGRAM ENGINE
 * Real-time 60/120fps Cursor-Tracking 3D Spatial Typography with Inertia Physics & Specular Caustic Glint
 * Designed for Adristy Akiko Yukinata Portfolio
 */

export function initAAY3DMonogram() {
    const stage = document.getElementById('aayStage');
    if (!stage) return;

    const sculpture = stage.querySelector('.aay-sculpture');
    const hudRotX = stage.querySelector('[data-hud="rotX"]');
    const hudRotY = stage.querySelector('[data-hud="rotY"]');
    const hudMode = stage.querySelector('[data-hud="mode"]');
    const starbursts = stage.querySelectorAll('.aay-starburst');
    const glintBtn = document.getElementById('aayGlintTrigger');
    const themeBtns = stage.querySelectorAll('[data-aay-theme]');
    const resetBtn = document.getElementById('aayResetTrigger');

    if (!sculpture) return;

    // Physics & Spatial State
    let currentRotX = -4;
    let currentRotY = 8;
    let currentRotZ = 0;

    let targetRotX = -4;
    let targetRotY = 8;
    let targetRotZ = 0;

    let velX = 0;
    let velY = 0;

    let isDragging = false;
    let isHovered = false;
    let dragStartX = 0;
    let dragStartY = 0;
    let lastDragX = 0;
    let lastDragY = 0;

    let isFlaring = false;
    let flareProgress = 0;
    let animFrameId = null;
    let isVisible = true;
    let time = 0;

    const lerp = (start, end, factor) => start + (end - start) * factor;

    // Check prefers-reduced-motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // 1. Pointer Tracking (Cursor Angle & Light Vectors)
    function handlePointerMove(clientX, clientY) {
        if (isDragging) return;

        const rect = stage.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        // Normalized offset [-1.0 to 1.0]
        const nx = Math.max(-1.2, Math.min(1.2, (clientX - centerX) / (rect.width / 2)));
        const ny = Math.max(-1.2, Math.min(1.2, (clientY - centerY) / (rect.height / 2)));

        if (prefersReducedMotion) {
            targetRotX = -ny * 6;
            targetRotY = nx * 8;
            targetRotZ = 0;
        } else {
            // Natural 3D pitch/yaw bounds
            targetRotX = -ny * 24;
            targetRotY = nx * 34;
            targetRotZ = nx * ny * -4;
        }

        // Specular Sheen Center
        const sheenX = Math.round(50 + nx * 40);
        const sheenY = Math.round(45 + ny * 35);
        stage.style.setProperty('--sheen-x', `${sheenX}%`);
        stage.style.setProperty('--sheen-y', `${sheenY}%`);

        // Light Angle in degrees
        const angle = Math.atan2(ny, nx) * (180 / Math.PI) + 90;
        stage.style.setProperty('--glint-angle', `${angle.toFixed(1)}deg`);
    }

    // Stage Mouse Events
    stage.addEventListener('mouseenter', (e) => {
        isHovered = true;
        if (hudMode) hudMode.textContent = 'TRACKING';
        handlePointerMove(e.clientX, e.clientY);
    });

    stage.addEventListener('mousemove', (e) => {
        if (!isDragging) {
            handlePointerMove(e.clientX, e.clientY);
        }
    });

    stage.addEventListener('mouseleave', () => {
        isHovered = false;
        if (!isDragging && hudMode) hudMode.textContent = 'FLOATING';
    });

    // 2. Drag-To-Spin Free Rotation & Inertia Physics
    stage.addEventListener('mousedown', (e) => {
        if (e.target.closest('button')) return; // Ignore button clicks
        isDragging = true;
        dragStartX = e.clientX;
        dragStartY = e.clientY;
        lastDragX = e.clientX;
        lastDragY = e.clientY;
        velX = 0;
        velY = 0;
        if (hudMode) hudMode.textContent = 'KINETIC';
    });

    window.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        const dx = e.clientX - lastDragX;
        const dy = e.clientY - lastDragY;

        velY = dx * 0.45;
        velX = -dy * 0.45;

        targetRotY += velY;
        targetRotX += velX;

        lastDragX = e.clientX;
        lastDragY = e.clientY;

        // Real-time specular sheen during drag
        const rect = stage.getBoundingClientRect();
        const nx = (e.clientX - (rect.left + rect.width / 2)) / (rect.width / 2);
        const ny = (e.clientY - (rect.top + rect.height / 2)) / (rect.height / 2);
        stage.style.setProperty('--sheen-x', `${50 + nx * 40}%`);
        stage.style.setProperty('--sheen-y', `${45 + ny * 35}%`);
    });

    window.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;
        if (hudMode) hudMode.textContent = isHovered ? 'TRACKING' : 'FLOATING';
    });

    // Touch Support for Mobile
    stage.addEventListener('touchstart', (e) => {
        if (e.target.closest('button')) return;
        if (e.touches.length === 1) {
            isDragging = true;
            dragStartX = e.touches[0].clientX;
            dragStartY = e.touches[0].clientY;
            lastDragX = dragStartX;
            lastDragY = dragStartY;
            velX = 0;
            velY = 0;
        }
    }, { passive: true });

    stage.addEventListener('touchmove', (e) => {
        if (!isDragging || e.touches.length !== 1) return;
        const touch = e.touches[0];
        const dx = touch.clientX - lastDragX;
        const dy = touch.clientY - lastDragY;

        velY = dx * 0.45;
        velX = -dy * 0.45;

        targetRotY += velY;
        targetRotX += velX;

        lastDragX = touch.clientX;
        lastDragY = touch.clientY;
    }, { passive: true });

    stage.addEventListener('touchend', () => {
        isDragging = false;
    });

    // Device Orientation / Gyroscope (Mobile Tilt)
    if (window.DeviceOrientationEvent && typeof DeviceOrientationEvent.requestPermission !== 'function') {
        window.addEventListener('deviceorientation', (e) => {
            if (isDragging || isHovered) return;
            if (e.gamma !== null && e.beta !== null) {
                // gamma is left-to-right [-90 to 90], beta is front-to-back [-180 to 180]
                const tiltY = Math.max(-30, Math.min(30, e.gamma * 0.8));
                const tiltX = Math.max(-20, Math.min(20, (e.beta - 45) * 0.5));
                targetRotY = tiltY;
                targetRotX = -tiltX;
            }
        }, { passive: true });
    }

    // 3. Specular Glint & Flare Trigger
    function triggerGlint() {
        if (isFlaring) return;
        isFlaring = true;
        flareProgress = 0;

        const sweepEl = stage.querySelector('.aay-caustic-sweep');
        if (!sweepEl) return;

        let startTime = performance.now();
        const duration = 1100; // ms

        function stepFlare(now) {
            const elapsed = now - startTime;
            const progress = Math.min(1, elapsed / duration);
            
            // Ease in out cubic
            const ease = progress < 0.5 
                ? 4 * progress * progress * progress 
                : 1 - Math.pow(-2 * progress + 2, 3) / 2;

            const sweepX = -120 + ease * 240;
            const sweepY = -60 + ease * 120;
            stage.style.setProperty('--sweep-x', `${sweepX}%`);
            stage.style.setProperty('--sweep-y', `${sweepY}%`);

            // Flash starbursts mid-flare
            const starScale = Math.sin(progress * Math.PI) * 1.5;
            starbursts.forEach(star => {
                star.style.transform = `translateZ(36px) translate(-50%, -50%) scale(${starScale.toFixed(2)})`;
                star.style.setProperty('--star-opacity', (Math.sin(progress * Math.PI)).toFixed(2));
            });

            if (progress < 1) {
                requestAnimationFrame(stepFlare);
            } else {
                isFlaring = false;
                stage.style.setProperty('--sweep-x', '0%');
                stage.style.setProperty('--sweep-y', '0%');
                starbursts.forEach(star => {
                    star.style.transform = `translateZ(36px) translate(-50%, -50%) scale(1)`;
                    star.style.setProperty('--star-opacity', '0.4');
                });
            }
        }

        requestAnimationFrame(stepFlare);
    }

    if (glintBtn) {
        glintBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            triggerGlint();
        });
    }

    // 4. Reset Angle Trigger
    if (resetBtn) {
        resetBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            targetRotX = -4;
            targetRotY = 8;
            targetRotZ = 0;
            velX = 0;
            velY = 0;
            triggerGlint();
        });
    }

    // 5. Material Switcher (Themes: obsidian, sage, silver)
    themeBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const theme = btn.getAttribute('data-aay-theme');
            stage.setAttribute('data-theme', theme);

            themeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            triggerGlint();
        });
    });

    // 6. Main 60/120fps Animation Render Loop
    function renderLoop(timestamp) {
        if (!isVisible) {
            animFrameId = requestAnimationFrame(renderLoop);
            return;
        }

        time = timestamp * 0.001;

        // Apply Drag Inertia Decay
        if (!isDragging) {
            velX *= 0.93;
            velY *= 0.93;

            targetRotX += velX;
            targetRotY += velY;

            // Ambient floating oscillation when idle
            if (!isHovered && Math.abs(velX) < 0.01 && Math.abs(velY) < 0.01 && !prefersReducedMotion) {
                const idleRotX = Math.sin(time * 1.3) * 6;
                const idleRotY = Math.cos(time * 0.9) * 12;
                targetRotX = lerp(targetRotX, idleRotX, 0.02);
                targetRotY = lerp(targetRotY, idleRotY, 0.02);
            }
        }

        // Smooth Lerp Interpolation
        currentRotX = lerp(currentRotX, targetRotX, 0.08);
        currentRotY = lerp(currentRotY, targetRotY, 0.08);
        currentRotZ = lerp(currentRotZ, targetRotZ, 0.08);

        // Update CSS Variables on Sculpture
        sculpture.style.setProperty('--rot-x', `${currentRotX.toFixed(2)}deg`);
        sculpture.style.setProperty('--rot-y', `${currentRotY.toFixed(2)}deg`);
        sculpture.style.setProperty('--rot-z', `${currentRotZ.toFixed(2)}deg`);

        // Dynamic Starburst Flaring based on optical reflection alignment
        if (!isFlaring) {
            const opticalAlignment = Math.max(0, 1 - (Math.abs(currentRotX) / 25 + Math.abs(currentRotY) / 35) * 0.6);
            const pulse = opticalAlignment * (0.35 + Math.sin(time * 3) * 0.25);
            starbursts.forEach(star => {
                star.style.setProperty('--star-opacity', pulse.toFixed(2));
            });
        }

        // Update Real-Time HUD Telemetry
        if (hudRotX) {
            hudRotX.textContent = (currentRotX >= 0 ? '+' : '') + currentRotX.toFixed(1) + '°';
        }
        if (hudRotY) {
            hudRotY.textContent = (currentRotY >= 0 ? '+' : '') + currentRotY.toFixed(1) + '°';
        }

        animFrameId = requestAnimationFrame(renderLoop);
    }

    // 7. Performance & Battery Optimization (IntersectionObserver)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            isVisible = entry.isIntersecting;
        });
    }, { threshold: 0.1 });

    observer.observe(stage);

    // Initial Trigger Glint on entrance
    setTimeout(() => {
        triggerGlint();
    }, 600);

    animFrameId = requestAnimationFrame(renderLoop);
}
