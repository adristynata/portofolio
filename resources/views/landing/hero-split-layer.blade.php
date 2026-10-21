{{-- 
    Shared Hero Layer for Split Reveal Curtains.
    Rendered identically in both left and right split panels to maintain 
    100% seamless pixel-perfect alignment before scroll.
--}}
<div class="hero-layer-inner relative w-full h-[100dvh] min-h-[100dvh] flex flex-col justify-between items-center bg-[#0a0f0d] overflow-hidden select-none">
    
    {{-- Atmospheric Dark Glass & Sage Green Ambient Glow --}}
    <div class="absolute inset-0 pointer-events-none flex items-center justify-center overflow-hidden z-0">
        {{-- Central radial sage glow --}}
        <div class="w-[500px] sm:w-[650px] lg:w-[820px] h-[500px] sm:h-[650px] lg:h-[780px] rounded-full bg-gradient-to-tr from-[#758268]/20 via-[#A5B698]/10 to-transparent blur-[110px] opacity-75"></div>
        {{-- Architectural subtle dot grid --}}
        <div class="absolute inset-0 bg-[radial-gradient(#353535_1px,transparent_1px)] [background-size:32px_32px] opacity-20"></div>
        {{-- Bottom grounding gradient --}}
        <div class="absolute inset-x-0 bottom-0 h-44 bg-gradient-to-t from-[#0a0f0d] via-[#0a0f0d]/80 to-transparent"></div>
    </div>

    {{-- Main Visual Stage --}}
    <div class="relative z-10 w-full max-w-7xl mx-auto h-full flex flex-col justify-center items-center px-4 sm:px-8 lg:px-12 pt-16 pb-8">
        
        {{-- Big Bold Split Heading --}}
        <div class="w-full relative z-10 flex flex-col md:flex-row items-center justify-between my-auto pointer-events-none">
            
            {{-- Left Word: ADRISTY --}}
            <div class="hero-word-mask overflow-hidden flex justify-center md:justify-start w-full md:w-[42%] text-center md:text-left">
                <span class="hero-word-reveal hero-word-left inline-block font-black text-6xl sm:text-7xl md:text-7xl lg:text-8xl xl:text-9xl tracking-tighter text-[#f1eee6] uppercase drop-shadow-[0_20px_35px_rgba(0,0,0,0.85)]">
                    Adristy
                </span>
            </div>

            {{-- Center Space for Cutout Photo --}}
            <div class="hidden md:block w-[16%] pointer-events-none"></div>

            {{-- Right Word: AKIKO --}}
            <div class="hero-word-mask overflow-hidden flex justify-center md:justify-end w-full md:w-[42%] text-center md:text-right mt-2 md:mt-0">
                <span class="hero-word-reveal hero-word-right inline-block font-black text-6xl sm:text-7xl md:text-7xl lg:text-8xl xl:text-9xl tracking-tighter text-[#f1eee6] uppercase drop-shadow-[0_20px_35px_rgba(0,0,0,0.85)]">
                    Akiko
                </span>
            </div>

        </div>

        {{-- Centered Cutout Photo of Adristy (z-20, higher than text, between the two words) --}}
        <div class="hero-split-photo absolute left-1/2 -translate-x-1/2 bottom-0 z-20 pointer-events-none flex justify-center items-end w-[290px] sm:w-[380px] md:w-[430px] lg:w-[480px] xl:w-[530px] h-[72vh] sm:h-[78vh] lg:h-[84vh]">
            <img src="{{ $heroPhotoSrc }}" 
                 alt="{{ $profile->name ?? 'Adristy Akiko' }}" 
                 class="w-full h-full object-contain object-bottom drop-shadow-[0_25px_60px_rgba(0,0,0,0.95)] pointer-events-auto select-none"
                 style="mask-image: linear-gradient(to bottom, black 85%, transparent 100%); -webkit-mask-image: linear-gradient(to bottom, black 85%, transparent 100%);">
        </div>

        {{-- Serif Italic Subtitle Below Name (Fades out early on scroll) --}}
        <div class="hero-split-desc relative z-30 mt-6 sm:mt-10 max-w-2xl mx-auto text-center px-4 pointer-events-auto">
            <p class="font-serif italic text-sm sm:text-base md:text-lg lg:text-xl text-[#c5c2ba] leading-relaxed drop-shadow-[0_2px_10px_rgba(0,0,0,0.8)]">
                {{ $profile->hero_bio ?? 'Saya adalah Junior Web Developer sekaligus Software Engineering dari SMK Negeri 1 Bangsri yang berfokus pada pengembangan web modern, responsif, dan berperforma tinggi.' }}
            </p>
        </div>

    </div>

    {{-- Bottom Scroll Indicator --}}
    <div class="hero-split-desc absolute bottom-4 left-1/2 -translate-x-1/2 z-30 pointer-events-none flex flex-col items-center gap-1.5 opacity-60">
        <span class="text-[10px] uppercase font-mono tracking-widest text-[#a5b698]">Scroll to Reveal</span>
        <svg class="w-3.5 h-3.5 text-[#a5b698] animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>

</div>
