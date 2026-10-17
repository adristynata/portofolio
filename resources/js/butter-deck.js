/**
 * Butter.video Interactive Skills Deck:
 * 3D spring tilt, dynamic timeline scrubber, and auto-play playback
 */

export function initButterDeck() {
    const deck = document.getElementById('butter-skills-deck');
    if (!deck) return;

    const cards = deck.querySelectorAll('.butter-card');
    const playhead = document.getElementById('butter-playhead');
    const timecode = document.getElementById('butter-timecode');
    const playBtn = document.getElementById('butter-play-btn');
    const playIcon = document.getElementById('butter-play-icon');
    const pauseIcon = document.getElementById('butter-pause-icon');

    const totalCards = cards.length || 6;
    let isPlaying = true;
    let activeIndex = 0;
    let autoPlayTimer = null;

    // 1. Interactive 3D Tilt on Cards
    cards.forEach((card, index) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotX = -((y - centerY) / centerY) * 14;
            const rotY = ((x - centerX) / centerX) * 14;

            card.style.transform = `perspective(700px) rotateX(${rotX.toFixed(2)}deg) rotateY(${rotY.toFixed(2)}deg) scale3d(1.07, 1.07, 1.07) translateZ(12px)`;
            
            // Sync timeline playhead to this hovered card
            setPlayheadPosition(index);
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(700px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1) translateZ(0px)';
        });

        card.addEventListener('mouseenter', () => {
            if (isPlaying) {
                pauseAutoPlay();
            }
        });
    });

    // 2. Sync timeline playhead & timecode
    function setPlayheadPosition(index) {
        activeIndex = index;
        const progress = (index / Math.max(1, totalCards - 1));
        const minPercent = 4;
        const maxPercent = 94;
        const targetPercent = minPercent + progress * (maxPercent - minPercent);

        if (playhead) {
            playhead.style.left = `${targetPercent.toFixed(1)}%`;
        }

        if (timecode) {
            const sec = (index + 1).toString().padStart(2, '0');
            const totalSec = totalCards.toString().padStart(2, '0');
            timecode.textContent = `00:${sec}.00 / 00:${totalSec}.00`;
        }

        // Highlight active card border
        cards.forEach((c, i) => {
            if (i === index) {
                c.classList.add('ring-2', 'ring-cyan-400/50');
            } else {
                c.classList.remove('ring-2', 'ring-cyan-400/50');
            }
        });
    }

    // 3. Auto-play loop (Simulates Butter video player sequence)
    function startAutoPlay() {
        isPlaying = true;
        if (playIcon) playIcon.classList.add('hidden');
        if (pauseIcon) pauseIcon.classList.remove('hidden');

        clearInterval(autoPlayTimer);
        autoPlayTimer = setInterval(() => {
            activeIndex = (activeIndex + 1) % totalCards;
            setPlayheadPosition(activeIndex);
        }, 2200);
    }

    function pauseAutoPlay() {
        isPlaying = false;
        clearInterval(autoPlayTimer);
        if (playIcon) playIcon.classList.remove('hidden');
        if (pauseIcon) pauseIcon.classList.add('hidden');
    }

    if (playBtn) {
        playBtn.addEventListener('click', () => {
            if (isPlaying) {
                pauseAutoPlay();
            } else {
                startAutoPlay();
            }
        });
    }

    // Start playback initially
    setPlayheadPosition(0);
    startAutoPlay();
}
