<x-landing-layout>

    {{-- Navbar --}}
    @include('landing.navbar')
    
    {{-- ============================================================== --}}
    {{-- SPLIT REVEAL HERO & ABOUT SECTION ENGINE                       --}}
    {{-- ============================================================== --}}
    @php
        // Always default to the clean transparent cutout photo without background for Hero
        $heroPhotoSrc = asset('images/adristy_cutout.png');

        // Dynamic About Section photo: uses uploaded CMS profile photo, falls back to studio portrait
        $aboutPhotoSrc = asset('images/adristy_studio.png');
        if (!empty($profile->photo)) {
            if (str_starts_with($profile->photo, 'http') || str_starts_with($profile->photo, 'data:')) {
                $aboutPhotoSrc = $profile->photo;
            } elseif (str_starts_with($profile->photo, 'storage/')) {
                $aboutPhotoSrc = asset($profile->photo);
            } else {
                $aboutPhotoSrc = asset('storage/' . $profile->photo);
            }
        }
    @endphp

    {{-- ============================================================== --}}
    {{-- 1. HERO SECTION (#home) - BOON GLOBAL SPLIT TYPOGRAPHY         --}}
    {{-- ============================================================== --}}
    @php
        $rawProfileName = trim($profile->name ?? 'Adristy Akiko Yukinata');
        $nameWords = preg_split('/\s+/', $rawProfileName);
        // Kata 1: ADRISTY (Sisi Kiri, Sejajar Akiko)
        $firstName = $nameWords[0] ?? 'Adristy';
        // Kata 2: AKIKO (Sisi Kanan, Sejajar Adristy)
        $secondName = $nameWords[1] ?? 'Akiko';
        // Kata 3+: YUKINATA (Di Tengah, Meluncur ke Kiri Ikut Adristy)
        $thirdName = count($nameWords) >= 3 ? implode(' ', array_slice($nameWords, 2)) : (isset($nameWords[2]) ? $nameWords[2] : 'Yukinata');
        $heroBioText = trim($profile->hero_bio ?? '');
    @endphp

    <section id="home" class="hero-pinned-stage relative w-full h-[100dvh] min-h-[100dvh] overflow-hidden bg-[#0c0e0c] flex items-center justify-center">
        
        {{-- Luxury Atmospheric Dark Glass Backlight & Contrast Glow --}}
        <div class="hero-ambient-glow absolute inset-0 pointer-events-none flex items-center justify-center overflow-hidden z-0">
            <div class="w-[520px] sm:w-[720px] lg:w-[940px] h-[520px] sm:h-[720px] lg:h-[900px] rounded-full bg-gradient-to-tr from-[#758268]/20 via-[#A5B698]/12 to-transparent blur-[120px] opacity-85"></div>
            <div class="absolute inset-x-0 bottom-0 h-44 bg-gradient-to-t from-[#0c0e0c] via-[#0c0e0c]/85 to-transparent"></div>
        </div>


        {{-- FOTO CUTOUT TRANSPARAN ADRISTY (STAY DI TENGAH, TIDAK KEBELAH, z-20 DI DEPAN TEKS) --}}
        <div class="hero-stay-photo absolute left-1/2 -translate-x-1/2 top-[18vh] sm:top-auto bottom-0 z-20 flex justify-center items-start sm:items-end pointer-events-none w-full max-w-[340px] sm:max-w-[460px] md:max-w-[500px] lg:max-w-[540px] sm:h-full sm:max-h-[86vh]">
            <img src="{{ asset('images/adristy_cutout.png') }}?v=cutout-clean" 
                 alt="{{ $rawProfileName }}" 
                 class="hero-photo-soft-entrance w-full h-full object-contain object-top sm:object-bottom drop-shadow-[0_25px_60px_rgba(0,0,0,0.92)] select-none pointer-events-auto transition-transform duration-700 hover:scale-[1.01]"
                 style="mask-image: linear-gradient(to bottom, black 80%, transparent 100%); -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
        </div>

        {{-- SPLIT TYPOGRAPHY STAGE (BOON GLOBAL STYLE, z-10 DI BALIK FOTO) --}}
        <div class="relative z-10 w-full max-w-[1440px] mx-auto px-2 sm:px-10 lg:px-14 h-full flex flex-col justify-between pointer-events-none pt-24 sm:pt-24 pb-6 sm:pb-12">
            
            {{-- Spacer Top --}}
            <div class="w-full shrink-0"></div>

            {{-- Center Typography Stage --}}
            <div class="w-full flex flex-col space-y-1 sm:space-y-3 lg:space-y-4 mt-6 sm:my-auto">

                {{-- BARIS 1: ADRISTY (KIRI) DAN AKIKO (KANAN) SAMA RATA SEJAJAR DENGAN SPASI SIMETRIS & SEIMBANG --}}
                <div class="w-full flex items-baseline justify-center pointer-events-none">
                    {{-- Sisi Kiri: ADRISTY (Rata Kanan ke arah foto tengah) --}}
                    <div class="hero-anim-adristy flex-1 text-right pointer-events-auto pr-0.5 sm:pr-1">
                        <h1 class="hero-name-left text-4xl min-[390px]:text-[2.65rem] sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-black text-[#FFFFFF] sm:text-[#F0EEE8] tracking-[-0.02em] leading-none select-none uppercase drop-shadow-[0_4px_25px_rgba(0,0,0,0.95)] whitespace-nowrap">
                            {{ $firstName }}
                        </h1>
                    </div>

                    {{-- Center Head Spacer (Ramping & pas di balik kepala, tidak menutupi hijab) --}}
                    <div class="w-16 min-[390px]:w-20 sm:w-20 md:w-24 lg:w-24 xl:w-28 shrink-0 pointer-events-none"></div>

                    {{-- Sisi Kanan: AKIKO (Rata Kiri, spasi optik presisi identik dengan sisi kiri) --}}
                    <div class="hero-anim-akiko flex-1 text-left pointer-events-auto pl-0.5 sm:pl-1">
                        <h2 class="hero-name-right text-4xl min-[390px]:text-[2.65rem] sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-black text-[#FFFFFF] sm:text-[#F0EEE8] tracking-[-0.02em] leading-none select-none uppercase drop-shadow-[0_4px_25px_rgba(0,0,0,0.95)] whitespace-nowrap">
                            {{ $secondName }}
                        </h2>
                    </div>
                </div>

                {{-- BARIS 2: YUKINATA DI TENGAH (CENTERED HORIZONTALLY BEHIND PHOTO) --}}
                <div class="w-full flex justify-center items-center pointer-events-none mt-0.5 sm:-mt-5 md:-mt-8 lg:-mt-10 xl:-mt-12">
                    <div class="hero-anim-yukinata w-full text-center pointer-events-auto">
                        <h3 class="hero-name-center text-4xl min-[390px]:text-[2.65rem] sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-black text-[#c8dac0] sm:text-[#A5B698] tracking-[-0.02em] leading-none select-none uppercase drop-shadow-[0_4px_25px_rgba(0,0,0,0.95)] whitespace-nowrap">
                            {{ $thirdName }}
                        </h3>
                    </div>
                </div>

            </div>

            {{-- BOTTOM FLANK: SOCIAL ACCOUNTS DOCK (SISI KIRI BAWAH HERO STAGE) --}}
            <div class="w-full flex items-center justify-between pointer-events-none shrink-0 pt-4">
                
                {{-- Sisi Kiri: Social Media Accounts Dock --}}
                <div class="hero-anim-adristy flex items-center gap-3 text-left pointer-events-auto select-none">
                    @php
                        $githubUrl = !empty($profile->github_url) ? $profile->github_url : 'https://github.com';
                        $linkedinUrl = !empty($profile->linkedin_url) ? $profile->linkedin_url : 'https://linkedin.com';
                        $instagramUrl = !empty($profile->instagram_url) ? $profile->instagram_url : 'https://instagram.com';
                    @endphp

                    <div class="inline-flex items-center gap-1.5 sm:gap-2 p-1.5 rounded-2xl bg-[#121612]/85 border border-[#303d2b]/60 backdrop-blur-md shadow-xl shadow-black/50">
                        <!-- GitHub -->
                        <a href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer" title="GitHub" 
                           class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#181d16]/90 border border-[#354331]/60 flex items-center justify-center text-[#D8D6CF] hover:text-[#A5B698] hover:border-[#A5B698]/70 hover:bg-[#222b1f] hover:shadow-[0_0_15px_rgba(165,182,152,0.25)] transition-all duration-300 hover:scale-105 group">
                            <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>

                        <!-- LinkedIn -->
                        <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" title="LinkedIn" 
                           class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#181d16]/90 border border-[#354331]/60 flex items-center justify-center text-[#D8D6CF] hover:text-[#A5B698] hover:border-[#A5B698]/70 hover:bg-[#222b1f] hover:shadow-[0_0_15px_rgba(165,182,152,0.25)] transition-all duration-300 hover:scale-105 group">
                            <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                        </a>

                        <!-- Instagram -->
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" title="Instagram" 
                           class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#181d16]/90 border border-[#354331]/60 flex items-center justify-center text-[#D8D6CF] hover:text-[#A5B698] hover:border-[#A5B698]/70 hover:bg-[#222b1f] hover:shadow-[0_0_15px_rgba(165,182,152,0.25)] transition-all duration-300 hover:scale-105 group">
                            <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>

                    <div class="flex items-center gap-1.5 hidden sm:flex">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698]/70"></span>
                        <span class="text-[10px] sm:text-[11px] font-mono text-[#A5B698]/80 uppercase tracking-[0.2em] font-bold">
                            CONNECT
                        </span>
                    </div>
                </div>

                {{-- Sisi Kanan: Empty Spacer --}}
                <div class="hero-anim-akiko"></div>

            </div>

        </div>

    </section>

    {{-- ============================================================== --}}
    {{-- 2. ABOUT SECTION (#about) — EDITORIAL GALLERY & CLEAN NARRATIVE --}}
    {{-- Inspirasi Lookbook Editorial: Bebas Container AI & Clean        --}}
    {{-- ============================================================== --}}
    <section id="about" class="about-section relative w-full py-20 sm:py-28 lg:py-36 px-4 sm:px-6 lg:px-8 bg-[#0c0e0c] overflow-hidden">
        
        {{-- GIANT WATERMARK TYPOGRAPHY (TENTANG) --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none overflow-hidden z-0">
            <span class="text-[17vw] sm:text-[15vw] font-black uppercase tracking-tighter text-[#A5B698]/[0.045] leading-none whitespace-nowrap">
                TENTANG
            </span>
        </div>

        {{-- Subtle Atmospheric Glow --}}
        <div class="absolute -right-32 top-1/3 w-[500px] h-[500px] bg-[#758268]/10 rounded-full blur-[140px] pointer-events-none z-0"></div>
        <div class="absolute -left-32 bottom-10 w-[450px] h-[450px] bg-[#A5B698]/5 rounded-full blur-[140px] pointer-events-none z-0"></div>

        <div class="relative z-10 max-w-7xl mx-auto w-full">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                {{-- SISI KIRI: NARRATIVE STORY & HUMAN EDITORIAL (TANPA KOTAK / BENTO AI) --}}
                <div class="lg:col-span-6 xl:col-span-6 flex flex-col justify-center about-reveal-item">
                    
                    {{-- Minimalist Category Tag --}}
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span class="w-2 h-2 rounded-full bg-[#A5B698] animate-pulse"></span>
                        <span class="font-mono text-xs uppercase tracking-[0.2em] text-[#A5B698] font-bold">
                            // 02. PROFIL & DEDIKASI
                        </span>
                    </div>

                    {{-- Bold Expressive Headline (Bisa diedit via CMS: hero_bio) --}}
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#F0EEE8] tracking-tight leading-[1.12] mb-6">
                        @if(!empty($profile->hero_bio))
                            {!! nl2br(e($profile->hero_bio)) !!}
                        @else
                            Membangun Solusi Web yang <br class="hidden sm:inline">
                            <span class="text-[#A5B698]">Terstruktur & Handal.</span>
                        @endif
                    </h2>

                    {{-- Narrative Bio (Bisa diedit via CMS: bio, ringkas & padat tanpa teks hardcode tambahan) --}}
                    <div class="text-sm sm:text-base text-[#B0AFA9] leading-relaxed font-normal">
                        <p>
                            {!! nl2br(e($profile->bio ?? 'Saya Adristy Akiko Yukinata, siswi Rekayasa Perangkat Lunak dari SMK Negeri 1 Bangsri. Berfokus pada pengembangan web modern dan arsitektur backend, saya terbiasa membangun aplikasi berbasis Laravel, merancang basis data relasional MySQL, serta mengintegrasikan RESTful API yang aman dan efisien.')) !!}
                        </p>
                    </div>

                    {{-- Minimalist Editorial Facts (Bebas Kotak Container & Bebas Garis, Clean & Bernapas) --}}
                    <div class="pt-8 mt-8 grid grid-cols-2 sm:grid-cols-2 gap-y-5 gap-x-6">
                        <div>
                            <span class="block font-mono text-[10px] uppercase tracking-widest text-[#758268] font-bold">Pendidikan</span>
                            <span class="text-xs sm:text-sm font-semibold text-[#F0EEE8] mt-1 block">{{ $profile->education ?? 'SMK Negeri 1 Bangsri (RPL)' }}</span>
                        </div>

                        <div>
                            <span class="block font-mono text-[10px] uppercase tracking-widest text-[#758268] font-bold">Fokus Bidang</span>
                            <span class="text-xs sm:text-sm font-semibold text-[#F0EEE8] mt-1 block">{{ $profile->focus ?? 'Web & Backend Dev' }}</span>
                        </div>

                        <div>
                            <span class="block font-mono text-[10px] uppercase tracking-widest text-[#758268] font-bold">Domisili</span>
                            <span class="text-xs sm:text-sm font-semibold text-[#F0EEE8] mt-1 block">{{ $profile->location ?? 'Jepara, Jawa Tengah' }}</span>
                        </div>

                        <div>
                            <span class="block font-mono text-[10px] uppercase tracking-widest text-[#758268] font-bold">Status Kesiapan</span>
                            <span class="text-xs sm:text-sm font-semibold text-[#A5B698] mt-1 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698] animate-pulse"></span>
                                Siap Magang / Proyek
                            </span>
                        </div>
                    </div>

                    {{-- Action Links --}}
                    <div class="pt-8 flex flex-wrap items-center gap-5">
                        <a href="#project" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold uppercase tracking-wider bg-[#F0EEE8] text-[#0c0e0c] hover:bg-[#A5B698] transition-all duration-300 hover:shadow-lg hover:shadow-[#A5B698]/20">
                            <span>Jelajahi Proyek</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>

                </div>

                {{-- SISI KANAN: OVERLAPPING EDITORIAL FRAMED PHOTOS (RESPONSIF MOBILE DENGAN TATA LETAK SEIMBANG) --}}
                <div class="lg:col-span-6 xl:col-span-6 flex items-center justify-center about-reveal-item pt-8 lg:pt-0">
                    
                    <div class="relative w-full max-w-[340px] xs:max-w-[380px] sm:max-w-[540px] h-[330px] xs:h-[380px] sm:h-[480px] flex items-center justify-center mx-auto">

                        {{-- BINGKAI 2 (BELAKANG / KANAN): FULL COLOR STUDIO PORTRAIT (TILT RIGHT) --}}
                        <div class="absolute right-0 sm:right-4 top-2 sm:top-2 w-[165px] xs:w-[200px] sm:w-[280px] md:w-[300px] transform rotate-[4deg] sm:rotate-[6deg] hover:rotate-0 hover:scale-105 hover:z-30 transition-all duration-500 ease-out cursor-pointer group">
                            <div class="bg-[#F0EEE8] p-2 xs:p-2.5 sm:p-3 pb-6 xs:pb-8 sm:pb-11 rounded-[3px] shadow-[0_20px_50px_rgba(0,0,0,0.85)] border border-[#d6d3c7] transition-shadow duration-300 group-hover:shadow-[0_30px_70px_rgba(0,0,0,0.95)]">
                                <div class="relative aspect-[3/4] w-full overflow-hidden bg-[#161a15]">
                                    <img src="{{ $aboutPhotoSrc }}" 
                                         alt="{{ $profile->name ?? 'Adristy Akiko Yukinata' }} — Studio Portrait" 
                                         class="w-full h-full object-cover object-top filter contrast-[105%] transition-transform duration-700 group-hover:scale-105">
                                </div>
                                <div class="pt-2 sm:pt-4 px-1 flex items-center justify-between text-[#242424] font-mono text-[8px] sm:text-[10px] uppercase tracking-wider font-semibold">
                                    <span class="truncate max-w-[90px] sm:max-w-none">{{ $profile->name ?? 'Adristy Akiko' }}</span>
                                    <span class="text-[#758268]">Studio</span>
                                </div>
                            </div>
                        </div>

                        {{-- BINGKAI 1 (DEPAN / KIRI): DRAMATIC B&W CLOSE-UP PORTRAIT (TILT LEFT - OVERLAPPING) --}}
                        <div class="absolute left-0 sm:left-4 bottom-2 sm:bottom-2 z-20 w-[175px] xs:w-[210px] sm:w-[290px] md:w-[310px] transform -rotate-[4deg] sm:-rotate-[5deg] hover:rotate-0 hover:scale-105 hover:z-30 transition-all duration-500 ease-out cursor-pointer group">
                            <div class="bg-[#F0EEE8] p-2 xs:p-2.5 sm:p-3 pb-6 xs:pb-8 sm:pb-11 rounded-[3px] shadow-[0_30px_60px_rgba(0,0,0,0.9)] border border-[#d6d3c7] transition-shadow duration-300 group-hover:shadow-[0_40px_80px_rgba(0,0,0,0.95)]">
                                <div class="relative aspect-[3/4] w-full overflow-hidden bg-[#121212]">
                                    <img src="{{ $aboutPhotoSrc }}" 
                                         alt="{{ $profile->name ?? 'Adristy Akiko Yukinata' }} — Editorial Monochrome" 
                                         class="w-full h-full object-cover object-top filter grayscale contrast-[135%] brightness-[92%] transition-transform duration-700 group-hover:scale-105">
                                </div>
                                <div class="pt-2 sm:pt-4 px-1 flex items-center justify-between text-[#242424] font-mono text-[8px] sm:text-[10px] uppercase tracking-wider font-semibold">
                                    <span class="truncate max-w-[90px] sm:max-w-none">{{ $profile->focus ?? 'Web Developer' }}</span>
                                    <span class="text-[#758268] truncate max-w-[80px] sm:max-w-none">{{ $profile->education ?? 'SMK N 1 Bangsri' }}</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- === 3. SKILLS SECTION (#skill) === --}}
    <section id="skill" class="relative py-16 sm:py-24 bg-[#191919] border-t border-[#353535] overflow-hidden">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-14 reveal-init">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#20251d] text-[#A5B698] border border-[#444f3d] mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698]"></span>
                    Keahlian Teknis
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#F0EEE8] tracking-tight">
                    Teknologi yang Digunakan dan Dipahami
                </h2>
                <p class="text-[#929292] text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Kumpulan bahasa pemrograman, framework, dan tools yang saya gunakan dalam membangun aplikasi modern.
                </p>
            </div>

            {{-- Butter.video Inspired Interactive Skills Deck --}}
            <div id="butter-skills-deck" class="butter-deck rounded-[32px] sm:rounded-[38px] p-5 sm:p-8 lg:p-10 border border-[#353535] shadow-2xl relative reveal-scale reveal-delay-1">
                
                {{-- Deck Header Bar with Timecode & Controls --}}
                <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-[#353535]">
                    <div class="flex items-center gap-3 sm:gap-4">
                        {{-- Play / Pause Button --}}
                        <button type="button" id="butter-play-btn" title="Toggle Timeline Movement" class="w-9 h-9 rounded-xl bg-[#242424] hover:bg-[#2c2c2c] active:scale-95 text-[#F0EEE8] flex items-center justify-center transition border border-[#353535] shadow-md">
                            {{-- Pause Icon (Playing) --}}
                            <svg id="butter-pause-icon" class="w-4 h-4 text-[#A5B698]" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 01.75.75v12a.75.75 0 01-1.5 0v-12a.75.75 0 01.75-.75zm10.5 0a.75.75 0 01.75.75v12a.75.75 0 01-1.5 0v-12a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                            </svg>
                            {{-- Play Icon (Paused) --}}
                            <svg id="butter-play-icon" class="w-4 h-4 text-[#A5B698] hidden" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Digital Timecode Readout --}}
                        <div class="font-mono text-xs sm:text-sm font-extrabold text-[#F0EEE8] tracking-wider flex items-center gap-2">
                            <span id="butter-timecode" class="text-[#A5B698]">00:01.00 / 00:{{ sprintf('%02d', max(1, count($skills))) }}.00</span>
                        </div>
                    </div>

                    {{-- Right Status Pill --}}
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-mono font-bold tracking-widest uppercase bg-[#20251d] text-[#A5B698] border border-[#444f3d]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698] animate-ping"></span>
                            ACTIVE TECH STACK
                        </span>
                    </div>
                </div>

                {{-- Interactive Timeline Ruler & Scrubber --}}
                <div class="relative py-4 my-2 overflow-hidden">
                    {{-- Ruler Marks --}}
                    <div class="h-6 w-full timeline-ticks relative flex items-center justify-between text-[10px] font-mono text-[#929292] select-none px-2">
                        <span>0s</span>
                        @for ($s = 1; $s <= max(1, count($skills)); $s++)
                            <span class="{{ $s % 2 !== 0 && count($skills) > 5 && $s !== max(1, count($skills)) ? 'hidden sm:inline' : '' }}">{{ $s }}s</span>
                        @endfor
                    </div>

                    {{-- Dynamic Scrubber Playhead Capsule --}}
                    <div id="butter-playhead" class="butter-playhead absolute top-1/2 -translate-y-1/2 h-8 w-20 sm:w-24 rounded-full bg-[#242424]/95 border border-[#A5B698]/70 backdrop-blur-md flex items-center justify-center pointer-events-none select-none -translate-x-1/2 z-10" style="left: 6%;">
                        <div class="w-1.5 h-1.5 rounded-full bg-[#A5B698] animate-pulse mr-1.5"></div>
                        <span class="text-[10px] font-mono font-bold text-[#F0EEE8] tracking-widest">LIVE</span>
                    </div>
                </div>

                {{-- Squircle 3D Pillow Cards Track (Butter.video Deck) --}}
                @php
                    $techConfigs = [
                        'laravel' => [
                            'slug' => 'laravel',
                            'accent' => 'text-rose-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(255,45,32,0.55)]" viewBox="0 0 24 24" fill="#FF2D20"><path d="M23.642 5.43a.364.364 0 01.014.1v5.149c0 .135-.073.26-.189.326l-4.323 2.49v4.934a.378.378 0 01-.188.326L9.93 23.949a.316.316 0 01-.066.027c-.008.002-.016.008-.024.01a.348.348 0 01-.192 0c-.011-.002-.02-.008-.03-.012-.02-.008-.042-.014-.062-.025L.533 18.755a.376.376 0 01-.189-.326V2.974c0-.033.005-.066.014-.098.003-.012.01-.02.014-.032a.369.369 0 01.023-.058c.004-.013.015-.022.023-.033l.033-.045c.012-.01.025-.018.037-.027.014-.012.027-.024.041-.034H.53L5.043.05a.375.375 0 01.375 0L9.93 2.647h.002c.015.01.027.021.04.033l.038.027c.013.014.02.03.033.045.008.011.02.021.025.033.01.02.017.038.024.058.003.011.01.021.013.032.01.031.014.064.014.098v9.652l3.76-2.164V5.527c0-.033.004-.066.013-.098.003-.01.01-.02.013-.032a.487.487 0 01.024-.059c.007-.012.018-.02.025-.033.012-.015.021-.03.033-.043.012-.012.025-.02.037-.028.014-.01.026-.023.041-.032h.001l4.513-2.598a.375.375 0 01.375 0l4.513 2.598c.016.01.027.021.042.031.012.01.025.018.036.028.013.014.022.03.034.044.008.012.019.021.024.033.011.02.018.04.024.06.006.01.012.021.015.032zm-.74 5.032V6.179l-1.578.908-2.182 1.256v4.283zm-4.51 7.75v-4.287l-2.147 1.225-6.126 3.498v4.325zM1.093 3.624v14.588l8.273 4.761v-4.325l-4.322-2.445-.002-.003H5.04c-.014-.01-.025-.021-.04-.031-.011-.01-.024-.018-.035-.027l-.001-.002c-.013-.012-.021-.025-.031-.04-.01-.011-.021-.022-.028-.036h-.002c-.008-.014-.013-.031-.02-.047-.006-.016-.014-.027-.018-.043a.49.49 0 01-.008-.057c-.002-.014-.006-.027-.006-.041V5.789l-2.18-1.257zM5.23.81L1.47 2.974l3.76 2.164 3.758-2.164zm1.956 13.505l2.182-1.256V3.624l-1.58.91-2.182 1.255v9.435zm11.581-10.95l-3.76 2.163 3.76 2.163 3.759-2.164zm-.376 4.978L16.21 7.087 14.63 6.18v4.283l2.182 1.256 1.58.908zm-8.65 9.654l5.514-3.148 2.756-1.572-3.757-2.163-4.323 2.489-3.941 2.27z"/></svg>'
                        ],
                        'html & css' => [
                            'slug' => 'html-css',
                            'accent' => 'text-orange-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(227,79,38,0.55)]" viewBox="0 0 24 24" fill="#E34F26"><path d="M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059.003.23-2.622L5.412 4.41l.698 8.01h9.126l-.326 3.426-2.91.804-2.955-.81-.188-2.11H6.248l.33 4.171L12 19.351l5.379-1.443.744-8.157H8.531z"/></svg>'
                        ],
                        'tailwind css' => [
                            'slug' => 'tailwind-css',
                            'accent' => 'text-cyan-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(6,182,212,0.55)]" viewBox="0 0 24 24" fill="#06B6D4"><path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z"/></svg>'
                        ],
                        'javascript' => [
                            'slug' => 'javascript',
                            'accent' => 'text-amber-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(247,223,30,0.55)] rounded-xl" viewBox="0 0 24 24" fill="#F7DF1E"><path d="M0 0h24v24H0V0zm22.034 18.276c-.175-1.095-.888-2.015-3.003-2.873-.736-.345-1.554-.585-1.797-1.14-.091-.33-.105-.51-.046-.705.15-.646.915-.84 1.515-.66.39.12.75.42.976.9 1.034-.676 1.034-.676 1.755-1.125-.27-.42-.404-.601-.586-.78-.63-.705-1.469-1.065-2.834-1.034l-.705.089c-.676.165-1.32.525-1.71 1.005-1.14 1.291-.811 3.541.569 4.471 1.365 1.02 3.361 1.244 3.616 2.205.24 1.17-.87 1.545-1.966 1.41-.811-.18-1.26-.586-1.755-1.336l-1.83 1.051c.21.48.45.689.81 1.109 1.74 1.756 6.09 1.666 6.871-1.004.029-.09.24-.705.074-1.65l.046.067zm-8.983-7.245h-2.248c0 1.938-.009 3.864-.009 5.805 0 1.232.063 2.363-.138 2.711-.33.689-1.18.601-1.566.48-.396-.196-.597-.466-.83-.855-.063-.105-.11-.196-.127-.196l-1.825 1.125c.305.63.75 1.172 1.324 1.517.855.51 2.004.675 3.207.405.783-.226 1.458-.691 1.811-1.411.51-.93.402-2.07.397-3.346.012-2.054 0-4.109 0-6.179l.004-.056z"/></svg>'
                        ],
                        'php' => [
                            'slug' => 'php',
                            'accent' => 'text-indigo-400',
                            'icon' => '<svg class="w-14 h-9 sm:w-16 sm:h-10 drop-shadow-[0_4px_12px_rgba(72,76,137,0.45)]" viewBox="0 0 711.20123 383.5975" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><radialGradient id="phpWikiGrad" cx="0" cy="0" r="1" gradientTransform="matrix(363.05789,0,0,-363.05789,177.52002,256.30713)" gradientUnits="userSpaceOnUse" spreadMethod="pad"><stop offset="0" stop-color="#aeb2d5"/><stop offset="0.3" stop-color="#aeb2d5"/><stop offset="0.75" stop-color="#484c89"/><stop offset="1" stop-color="#484c89"/></radialGradient></defs><g transform="matrix(1.25,0,0,-1.25,-4.4,394.29875)"><g><path d="M 11.52,162 C 11.52,81.677 135.307,16.561 288,16.561 l 0,0 c 152.693,0 276.481,65.116 276.481,145.439 l 0,0 c 0,80.322 -123.788,145.439 -276.481,145.439 l 0,0 C 135.307,307.439 11.52,242.322 11.52,162" fill="url(#phpWikiGrad)"/></g><g transform="translate(288,27.3594)"><path d="M 0,0 C 146.729,0 265.68,60.281 265.68,134.641 265.68,209 146.729,269.282 0,269.282 -146.729,269.282 -265.68,209 -265.68,134.641 -265.68,60.281 -146.729,0 0,0" fill="#777bb3"/></g><g transform="translate(159.2236,197.3071)"><path d="m 0,0 16.808,0 c 13.421,0 18.083,-2.945 19.667,-4.7 2.628,-2.914 3.124,-9.058 1.435,-17.767 C 36.012,-32.217 32.494,-39.13 27.452,-43.012 22.29,-46.986 13.898,-49 2.511,-49 L -9.523,-49 0,0 Z m 28.831,35 -61.055,0 c -2.872,0 -5.341,-2.036 -5.889,-4.855 l -28.328,-145.751 c -0.342,-1.759 0.12,-3.578 1.259,-4.961 1.14,-1.383 2.838,-2.183 4.63,-2.183 l 31.75,0 c 2.873,0 5.342,2.036 5.89,4.855 l 6.588,33.895 22.249,0 c 12.582,0 23.174,1.372 31.479,4.077 8.541,2.775 16.399,7.48 23.354,13.984 5.752,5.292 10.49,11.232 14.08,17.657 3.591,6.427 6.171,13.594 7.668,21.302 3.715,19.104 0.697,34.402 -8.969,45.466 C 63.965,29.444 48.923,35 28.831,35 m -45.633,-90 19.313,0 c 12.801,0 22.336,2.411 28.601,7.234 6.266,4.824 10.492,12.875 12.688,24.157 2.101,10.832 1.144,18.476 -2.871,22.929 C 36.909,3.773 28.87,6 16.808,6 L -4.946,6 -16.802,-55 M 28.831,29 C 47.198,29 60.597,24.18 69.019,14.539 77.44,4.898 79.976,-8.559 76.616,-25.836 75.233,-32.953 72.894,-39.46 69.601,-45.355 66.304,-51.254 61.999,-56.648 56.679,-61.539 50.339,-67.472 43.296,-71.7 35.546,-74.218 27.796,-76.743 17.925,-78 5.925,-78 l -27.196,0 -7.531,-38.75 -31.75,0 28.328,145.75 61.055,0" fill="#ffffff"/></g><g transform="translate(161.7344,145.3066)"><path d="m 0,0 c 12.065,0 21.072,2.225 26.771,6.611 5.638,4.341 9.532,11.862 11.573,22.353 1.903,9.806 1.178,16.653 -2.154,20.348 C 32.783,53.086 25.417,55 14.297,55 L -4.984,55 -15.673,0 0,0 Z m -63.063,-67.75 c -0.895,0 -1.745,0.4 -2.314,1.092 -0.57,0.691 -0.801,1.601 -0.63,2.48 L -37.679,81.573 C -37.405,82.982 -36.17,84 -34.734,84 L 26.32,84 C 45.508,84 59.79,78.79 68.767,68.513 77.792,58.182 80.579,43.741 77.05,25.592 75.614,18.198 73.144,11.331 69.709,5.183 66.27,-0.972 61.725,-6.667 56.198,-11.747 49.582,-17.939 42.094,-22.429 33.962,-25.071 25.959,-27.678 15.681,-29 3.414,-29 l -24.722,0 -7.06,-36.322 c -0.274,-1.41 -1.508,-2.428 -2.944,-2.428 l -31.751,0 z" fill="#000000"/></g><g transform="translate(293.6611,271.0571)"><path d="m 0,0 -31.5,0 c -2.873,0 -5.342,-2.036 -5.89,-4.855 l -28.328,-145.751 c -0.342,-1.759 0.12,-3.578 1.26,-4.961 1.14,-1.383 2.838,-2.183 4.63,-2.183 l 31.5,0 c 2.872,0 5.342,2.036 5.89,4.855 l 15.283,78.645 20.229,0 c 9.363,0 11.328,-2 11.407,-2.086 0.568,-0.611 1.315,-3.441 0.082,-9.781 l -12.531,-64.489 c -0.342,-1.759 0.12,-3.578 1.26,-4.961 1.14,-1.383 2.838,-2.183 4.63,-2.183 l 32,0 c 2.872,0 5.342,2.036 5.89,4.855 l 13.179,67.825 c 3.093,15.921 0.447,27.864 -7.861,35.5 -7.928,7.281 -21.208,10.82 -40.599,10.82 l -20.784,0 6.143,31.605 C 6.231,-5.386 5.77,-3.566 4.63,-2.184 3.49,-0.801 1.792,0 0,0 m 0,-6 -7.531,-38.75 28.062,0 c 17.657,0 29.836,-3.082 36.539,-9.238 6.703,-6.16 8.711,-16.141 6.032,-29.938 l -13.18,-67.824 -32,0 12.531,64.488 c 1.426,7.336 0.902,12.34 -1.574,15.008 -2.477,2.668 -7.746,4.004 -15.805,4.004 l -25.176,0 -16.226,-83.5 -31.5,0 L -31.5,-6 0,-6" fill="#ffffff"/></g><g transform="translate(311.583,116.3066)"><path d="m 0,0 c -0.896,0 -1.745,0.4 -2.314,1.092 -0.571,0.691 -0.802,1.6 -0.631,2.48 L 9.586,68.061 C 10.778,74.194 10.484,78.596 8.759,80.456 7.703,81.593 4.531,83.5 -4.848,83.5 L -27.55,83.5 -43.305,2.428 C -43.579,1.018 -44.814,0 -46.25,0 l -31.5,0 c -0.896,0 -1.745,0.4 -2.315,1.092 -0.57,0.691 -0.801,1.601 -0.63,2.48 l 28.328,145.751 c 0.274,1.409 1.509,2.427 2.945,2.427 l 31.5,0 c 0.896,0 1.745,-0.4 2.315,-1.091 0.57,-0.692 0.801,-1.601 0.63,-2.481 L -21.813,113 2.609,113 c 18.605,0 31.221,-3.28 38.569,-10.028 7.49,-6.884 9.827,-17.891 6.947,-32.719 L 34.945,2.428 C 34.671,1.018 33.437,0 32,0 L 0,0 Z" fill="#000000"/></g><g transform="translate(407.0391,197.3071)"><path d="M 0,0 16.808,0 C 30.229,0 34.891,-2.945 36.475,-4.7 39.104,-7.614 39.6,-13.758 37.91,-22.466 36.012,-32.217 32.493,-39.13 27.452,-43.012 22.29,-46.986 13.898,-49 2.511,-49 L -9.522,-49 0,0 Z m 28.831,35 -61.054,0 c -2.872,0 -5.341,-2.036 -5.889,-4.855 L -66.44,-115.606 c -0.342,-1.759 0.12,-3.578 1.259,-4.961 1.14,-1.383 2.838,-2.183 4.63,-2.183 l 31.75,0 c 2.872,0 5.342,2.036 5.89,4.855 l 6.587,33.895 22.249,0 c 12.582,0 23.174,1.372 31.479,4.077 8.541,2.775 16.401,7.481 23.356,13.986 5.752,5.291 10.488,11.23 14.078,17.655 3.591,6.427 6.171,13.594 7.668,21.302 3.715,19.105 0.697,34.403 -8.969,45.467 C 63.965,29.444 48.924,35 28.831,35 m -45.632,-90 19.312,0 c 12.801,0 22.336,2.411 28.601,7.234 6.267,4.824 10.492,12.875 12.688,24.157 2.102,10.832 1.145,18.476 -2.871,22.929 C 36.909,3.773 28.87,6 16.808,6 L -4.946,6 -16.801,-55 M 28.831,29 C 47.198,29 60.597,24.18 69.019,14.539 77.441,4.898 79.976,-8.559 76.616,-25.836 75.233,-32.953 72.894,-39.46 69.601,-45.355 66.304,-51.254 61.999,-56.648 56.679,-61.539 50.339,-67.472 43.296,-71.7 35.546,-74.218 27.796,-76.743 17.925,-78 5.925,-78 l -27.196,0 -7.53,-38.75 -31.75,0 28.328,145.75 61.054,0" fill="#ffffff"/></g><g transform="translate(409.5498,145.3066)"><path d="m 0,0 c 12.065,0 21.072,2.225 26.771,6.611 5.638,4.34 9.532,11.861 11.574,22.353 1.903,9.806 1.178,16.653 -2.155,20.348 C 32.783,53.086 25.417,55 14.297,55 L -4.984,55 -15.673,0 0,0 Z m -63.062,-67.75 c -0.895,0 -1.745,0.4 -2.314,1.092 -0.57,0.691 -0.802,1.601 -0.631,2.48 L -37.679,81.573 C -37.404,82.982 -36.17,84 -34.733,84 L 26.32,84 C 45.509,84 59.79,78.79 68.768,68.513 77.793,58.183 80.579,43.742 77.051,25.592 75.613,18.198 73.144,11.331 69.709,5.183 66.27,-0.972 61.725,-6.667 56.198,-11.747 49.582,-17.939 42.094,-22.429 33.962,-25.071 25.959,-27.678 15.681,-29 3.414,-29 l -24.723,0 -7.057,-36.322 c -0.275,-1.41 -1.509,-2.428 -2.946,-2.428 l -31.75,0 z" fill="#000000"/></g></g></svg>'
                        ],
                        'mysql' => [
                            'slug' => 'mysql',
                            'accent' => 'text-sky-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(56,189,248,0.6)]" viewBox="0 0 24 24" fill="#38BDF8"><path d="M16.405 5.501c-.115 0-.193.014-.274.033v.013h.014c.054.104.146.18.214.273.054.107.1.214.154.32l.014-.015c.094-.066.14-.172.14-.333-.04-.047-.046-.094-.08-.14-.04-.067-.126-.1-.18-.153zM5.77 18.695h-.927a50.854 50.854 0 00-.27-4.41h-.008l-1.41 4.41H2.45l-1.4-4.41h-.01a72.892 72.892 0 00-.195 4.41H0c.055-1.966.192-3.81.41-5.53h1.15l1.335 4.064h.008l1.347-4.064h1.095c.242 2.015.384 3.86.428 5.53zm4.017-4.08c-.378 2.045-.876 3.533-1.492 4.46-.482.716-1.01 1.073-1.583 1.073-.153 0-.34-.046-.566-.138v-.494c.11.017.24.026.386.026.268 0 .483-.075.647-.222.197-.18.295-.382.295-.605 0-.155-.077-.47-.23-.944L6.23 14.615h.91l.727 2.36c.164.536.233.91.205 1.123.4-1.064.678-2.227.835-3.483zm12.325 4.08h-2.63v-5.53h.885v4.85h1.745zm-3.32.135l-1.016-.5c.09-.076.177-.158.255-.25.433-.506.648-1.258.648-2.253 0-1.83-.718-2.746-2.155-2.746-.704 0-1.254.232-1.65.697-.43.508-.646 1.256-.646 2.245 0 .972.19 1.686.574 2.14.35.41.877.615 1.583.615.264 0 .506-.033.725-.098l1.325.772.36-.622zM15.5 17.588c-.225-.36-.337-.94-.337-1.736 0-1.393.424-2.09 1.27-2.09.443 0 .77.167.977.5.224.362.336.936.336 1.723 0 1.404-.424 2.108-1.27 2.108-.445 0-.77-.167-.978-.5zm-1.658-.425c0 .47-.172.856-.516 1.156-.344.3-.803.45-1.384.45-.543 0-1.064-.172-1.573-.515l.237-.476c.438.22.833.328 1.19.328.332 0 .593-.073.783-.22a.754.754 0 00.3-.615c0-.33-.23-.61-.648-.845-.388-.213-1.163-.657-1.163-.657-.422-.307-.632-.636-.632-1.177 0-.45.157-.81.47-1.085.315-.278.72-.415 1.22-.415.512 0 .98.136 1.4.41l-.213.476a2.726 2.726 0 00-1.064-.23c-.283 0-.502.068-.654.206a.685.685 0 00-.248.524c0 .328.234.61.666.85.393.215 1.187.67 1.187.67.433.305.648.63.648 1.168zm9.382-5.852c-.535-.014-.95.04-1.297.188-.1.04-.26.04-.274.167.055.053.063.14.11.214.08.134.218.313.346.407.14.11.28.216.427.31.26.16.555.255.81.416.145.094.293.213.44.313.073.05.12.14.214.172v-.02c-.046-.06-.06-.147-.105-.214-.067-.067-.134-.127-.2-.193a3.223 3.223 0 00-.695-.675c-.214-.146-.682-.35-.77-.595l-.013-.014c.146-.013.32-.066.46-.106.227-.06.435-.047.67-.106.106-.027.213-.06.32-.094v-.06c-.12-.12-.21-.283-.334-.395a8.867 8.867 0 00-1.104-.823c-.21-.134-.476-.22-.697-.334-.08-.04-.214-.06-.26-.127-.12-.146-.19-.34-.275-.514a17.69 17.69 0 01-.547-1.163c-.12-.262-.193-.523-.34-.763-.69-1.137-1.437-1.826-2.586-2.5-.247-.14-.543-.2-.856-.274-.167-.008-.334-.02-.5-.027-.11-.047-.216-.174-.31-.235-.38-.24-1.364-.76-1.644-.072-.18.434.267.862.422 1.082.115.153.26.328.34.5.047.116.06.235.107.356.106.294.207.622.347.897.073.14.153.287.247.413.054.073.146.107.167.227-.094.136-.1.334-.154.5-.24.757-.146 1.693.194 2.25.107.166.362.534.703.393.3-.12.234-.5.32-.835.02-.08.007-.133.048-.187v.015c.094.188.188.367.274.555.206.328.566.668.867.895.16.12.287.328.487.402v-.02h-.015c-.043-.058-.1-.086-.154-.133a3.445 3.445 0 01-.35-.4 8.76 8.76 0 01-.747-1.218c-.11-.21-.202-.436-.29-.643-.04-.08-.04-.2-.107-.24-.1.146-.247.273-.32.453-.127.288-.14.642-.188 1.01-.027.007-.014 0-.027.014-.214-.052-.287-.274-.367-.46-.2-.475-.233-1.238-.06-1.785.047-.14.247-.582.167-.716-.042-.127-.174-.2-.247-.303a2.478 2.478 0 01-.24-.427c-.16-.374-.24-.788-.414-1.162-.08-.173-.22-.354-.334-.513-.127-.18-.267-.307-.368-.52-.033-.073-.08-.194-.027-.274.014-.054.042-.075.094-.09.088-.072.335.022.422.062.247.1.455.194.662.334.094.066.195.193.315.226h.14c.214.047.455.014.655.073.355.114.675.28.962.46a5.953 5.953 0 012.085 2.286c.08.154.115.295.188.455.14.33.313.663.455.982.14.315.275.636.476.897.1.14.502.213.682.286.133.06.34.115.46.188.23.14.454.3.67.454.11.076.443.243.463.378z"/></svg>'
                        ],
                        'figma' => [
                            'slug' => 'figma',
                            'accent' => 'text-purple-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(162,89,255,0.55)]" viewBox="0 0 38 57" fill="none"><path d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z" fill="#1ABCFE"/><path d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z" fill="#0ACF83"/><path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z" fill="#FF7262"/><path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z" fill="#F24E1E"/><path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z" fill="#A259FF"/></svg>'
                        ],
                        'mongodb' => [
                            'slug' => 'mongodb',
                            'accent' => 'text-emerald-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(19,170,82,0.55)]" viewBox="0 0 24 24" fill="#13AA52"><path d="M17.193 9.555c-1.264-5.58-4.252-7.414-4.573-8.115-.28-.394-.53-.954-.735-1.44-.036.495-.055.685-.523 1.184-.723.566-4.438 3.682-4.74 10.02-.282 5.912 4.27 9.435 4.888 9.884l.07.05A73.49 73.49 0 0111.91 24h.481c.114-1.032.284-2.056.51-3.07.417-.296.604-.463.85-.693a11.342 11.342 0 003.639-8.464c.01-.814-.103-1.662-.197-2.218zm-5.336 8.195s0-8.291.275-8.29c.213 0 .49 10.695.49 10.695-.381-.045-.765-1.76-.765-2.405z"/></svg>'
                        ],
                        'mongo db' => [
                            'slug' => 'mongodb',
                            'accent' => 'text-emerald-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(19,170,82,0.55)]" viewBox="0 0 24 24" fill="#13AA52"><path d="M17.193 9.555c-1.264-5.58-4.252-7.414-4.573-8.115-.28-.394-.53-.954-.735-1.44-.036.495-.055.685-.523 1.184-.723.566-4.438 3.682-4.74 10.02-.282 5.912 4.27 9.435 4.888 9.884l.07.05A73.49 73.49 0 0111.91 24h.481c.114-1.032.284-2.056.51-3.07.417-.296.604-.463.85-.693a11.342 11.342 0 003.639-8.464c.01-.814-.103-1.662-.197-2.218zm-5.336 8.195s0-8.291.275-8.29c.213 0 .49 10.695.49 10.695-.381-.045-.765-1.76-.765-2.405z"/></svg>'
                        ],
                        'postman' => [
                            'slug' => 'postman',
                            'accent' => 'text-orange-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(255,108,55,0.55)]" viewBox="0 0 24 24" fill="#FF6C37"><path d="M13.527.099C6.955-.744.942 3.9.099 10.473c-.843 6.572 3.8 12.584 10.373 13.428 6.573.843 12.587-3.801 13.428-10.374C24.744 6.955 20.101.943 13.527.099zm2.471 7.485a.855.855 0 0 0-.593.25l-4.453 4.453-.307-.307-.643-.643c4.389-4.376 5.18-4.418 5.996-3.753zm-4.863 4.861l4.44-4.44a.62.62 0 1 1 .847.903l-4.699 4.125-.588-.588zm.33.694l-1.1.238a.06.06 0 0 1-.067-.032.06.06 0 0 1 .01-.073l.645-.645.512.512zm-2.803-.459l1.172-1.172.879.878-1.979.426a.074.074 0 0 1-.085-.039.072.072 0 0 1 .013-.093zm-3.646 6.058a.076.076 0 0 1-.069-.083.077.077 0 0 1 .022-.046h.002l.946-.946 1.222 1.222-2.123-.147zm2.425-1.256a.228.228 0 0 0-.117.256l.203.865a.125.125 0 0 1-.211.117h-.003l-.934-.934-.294-.295 3.762-3.758 1.82-.393.874.874c-1.255 1.102-2.971 2.201-5.1 3.268zm5.279-3.428h-.002l-.839-.839 4.699-4.125a.952.952 0 0 0 .119-.127c-.148 1.345-2.029 3.245-3.977 5.091zm3.657-6.46l-.003-.002a1.822 1.822 0 0 1 2.459-2.684l-1.61 1.613a.119.119 0 0 0 0 .169l1.247 1.247a1.817 1.817 0 0 1-2.093-.343zm2.578 0a1.714 1.714 0 0 1-.271.218h-.001l-1.207-1.207 1.533-1.533c.661.72.637 1.832-.054 2.522zM18.855 6.05a.143.143 0 0 0-.053.157.416.416 0 0 1-.053.45.14.14 0 0 0 .023.197.141.141 0 0 0 .084.03.14.14 0 0 0 .106-.05.691.691 0 0 0 .087-.751.138.138 0 0 0-.194-.033z"/></svg>'
                        ],
                        'adobe illustrator' => [
                            'slug' => 'adobe-illustrator',
                            'accent' => 'text-amber-500',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(255,154,0,0.55)]" viewBox="0 0 24 24" fill="#FF9A00"><path d="M10.53 10.73c-.1-.31-.19-.61-.29-.92-.1-.31-.19-.6-.27-.89-.08-.28-.15-.54-.22-.78h-.02c-.09.43-.2.86-.34 1.29-.15.48-.3.98-.46 1.48-.14.51-.29.98-.44 1.4h2.54c-.06-.211-.14-.46-.23-.721-.09-.269-.18-.559-.27-.859zM19.75.3H4.25C1.9.3 0 2.2 0 4.55v14.9c0 2.35 1.9 4.25 4.25 4.25h15.5c2.35 0 4.25-1.9 4.25-4.25V4.55C24 2.2 22.1.3 19.75.3zM14.7 16.83h-2.091c-.069.01-.139-.04-.159-.11l-.82-2.38H7.91l-.76 2.35c-.02.09-.1.15-.19.141H5.08c-.11 0-.14-.061-.11-.18L8.19 7.38c.03-.1.06-.21.1-.33.04-.21.06-.43.06-.65-.01-.05.03-.1.08-.11h2.59c.08 0 .12.03.13.08l3.65 10.3c.03.109 0 .16-.1.16zm3.4-.15c0 .11-.039.16-.129.16H16.01c-.1 0-.15-.061-.15-.16v-7.7c0-.1.041-.14.131-.14h1.98c.09 0 .129.05.129.14v7.7zm-.209-9.03c-.231.24-.571.37-.911.35-.33.01-.65-.12-.891-.35-.23-.25-.35-.58-.34-.92-.01-.34.12-.66.359-.89.242-.23.562-.35.892-.35.391 0 .689.12.91.35.22.24.34.56.33.89.01.34-.11.67-.349.92z"/></svg>'
                        ],
                        'illustrator' => [
                            'slug' => 'adobe-illustrator',
                            'accent' => 'text-amber-500',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(255,154,0,0.55)]" viewBox="0 0 24 24" fill="#FF9A00"><path d="M10.53 10.73c-.1-.31-.19-.61-.29-.92-.1-.31-.19-.6-.27-.89-.08-.28-.15-.54-.22-.78h-.02c-.09.43-.2.86-.34 1.29-.15.48-.3.98-.46 1.48-.14.51-.29.98-.44 1.4h2.54c-.06-.211-.14-.46-.23-.721-.09-.269-.18-.559-.27-.859zM19.75.3H4.25C1.9.3 0 2.2 0 4.55v14.9c0 2.35 1.9 4.25 4.25 4.25h15.5c2.35 0 4.25-1.9 4.25-4.25V4.55C24 2.2 22.1.3 19.75.3zM14.7 16.83h-2.091c-.069.01-.139-.04-.159-.11l-.82-2.38H7.91l-.76 2.35c-.02.09-.1.15-.19.141H5.08c-.11 0-.14-.061-.11-.18L8.19 7.38c.03-.1.06-.21.1-.33.04-.21.06-.43.06-.65-.01-.05.03-.1.08-.11h2.59c.08 0 .12.03.13.08l3.65 10.3c.03.109 0 .16-.1.16zm3.4-.15c0 .11-.039.16-.129.16H16.01c-.1 0-.15-.061-.15-.16v-7.7c0-.1.041-.14.131-.14h1.98c.09 0 .129.05.129.14v7.7zm-.209-9.03c-.231.24-.571.37-.911.35-.33.01-.65-.12-.891-.35-.23-.25-.35-.58-.34-.92-.01-.34.12-.66.359-.89.242-.23.562-.35.892-.35.391 0 .689.12.91.35.22.24.34.56.33.89.01.34-.11.67-.349.92z"/></svg>'
                        ],
                        'arduino ide' => [
                            'slug' => 'arduino-ide',
                            'accent' => 'text-teal-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(0,151,157,0.65)]" viewBox="0 0 24 24" fill="#00979D"><path d="M23.82 12a5.78 5.78 0 0 0-5.88-5.67c-.29 0-.6.02-.9.05-2.52.37-4.2 2.18-5.13 3.57-.95-1.39-2.64-3.2-5.14-3.57-.3-.03-.6-.05-.9-.05A5.78 5.78 0 0 0 0 12a5.78 5.78 0 0 0 5.87 5.67c.3 0 .6-.02.92-.06 2.52-.36 4.2-2.17 5.14-3.56.95 1.39 2.63 3.2 5.14 3.57.31.03.6.05.91.05A5.78 5.78 0 0 0 23.82 12zM6.48 15.6c-.2.04-.43.04-.63.04A3.77 3.77 0 0 1 2 11.98a3.78 3.78 0 0 1 3.86-3.66c.2 0 .42.02.63.04 2.37.35 3.82 2.67 4.31 3.62-.5.95-1.95 3.3-4.31 3.62zm13-3.6c.49-.93 1.94-3.27 4.31-3.62.2-.04.42-.04.62-.04A3.76 3.76 0 0 1 21.8 12a3.78 3.78 0 0 1-3.86 3.66c-.2 0-.42-.02-.62-.04-2.36-.35-3.82-2.69-4.31-3.62zm-8.79.59h3.54v-1.16H4.22v1.16zm14.13 0h1.19v-1.16h-1.2v-1.19H17.2v1.2H16v1.15h1.2v1.18h1.15V12.6zM24 7.06c0 .3-.22.51-.53.51a.51.51 0 0 1-.53-.5c0-.28.24-.52.53-.52.31 0 .53.22.53.51zm-.91 0c0 .22.16.4.4.4.22 0 .38-.18.38-.4s-.16-.4-.38-.4c-.24-.02-.4.16-.4.4zm.3.26h-.1V6.8l.2-.01c.09 0 .14.01.18.03.04.02.06.06.06.11 0 .06-.04.1-.11.11.05.02.07.06.09.13l.03.13h-.12c-.02-.02-.02-.07-.04-.13-.02-.05-.04-.07-.11-.07h-.05l-.02.22zm.02-.3h.06c.07 0 .1-.01.1-.07 0-.05-.03-.07-.1-.07h-.07v.14h.01z"/></svg>'
                        ],
                        'arduino' => [
                            'slug' => 'arduino-ide',
                            'accent' => 'text-teal-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(0,151,157,0.65)]" viewBox="0 0 24 24" fill="#00979D"><path d="M23.82 12a5.78 5.78 0 0 0-5.88-5.67c-.29 0-.6.02-.9.05-2.52.37-4.2 2.18-5.13 3.57-.95-1.39-2.64-3.2-5.14-3.57-.3-.03-.6-.05-.9-.05A5.78 5.78 0 0 0 0 12a5.78 5.78 0 0 0 5.87 5.67c.3 0 .6-.02.92-.06 2.52-.36 4.2-2.17 5.14-3.56.95 1.39 2.63 3.2 5.14 3.57.31.03.6.05.91.05A5.78 5.78 0 0 0 23.82 12zM6.48 15.6c-.2.04-.43.04-.63.04A3.77 3.77 0 0 1 2 11.98a3.78 3.78 0 0 1 3.86-3.66c.2 0 .42.02.63.04 2.37.35 3.82 2.67 4.31 3.62-.5.95-1.95 3.3-4.31 3.62zm13-3.6c.49-.93 1.94-3.27 4.31-3.62.2-.04.42-.04.62-.04A3.76 3.76 0 0 1 21.8 12a3.78 3.78 0 0 1-3.86 3.66c-.2 0-.42-.02-.62-.04-2.36-.35-3.82-2.69-4.31-3.62zm-8.79.59h3.54v-1.16H4.22v1.16zm14.13 0h1.19v-1.16h-1.2v-1.19H17.2v1.2H16v1.15h1.2v1.18h1.15V12.6zM24 7.06c0 .3-.22.51-.53.51a.51.51 0 0 1-.53-.5c0-.28.24-.52.53-.52.31 0 .53.22.53.51zm-.91 0c0 .22.16.4.4.4.22 0 .38-.18.38-.4s-.16-.4-.38-.4c-.24-.02-.4.16-.4.4zm.3.26h-.1V6.8l.2-.01c.09 0 .14.01.18.03.04.02.06.06.06.11 0 .06-.04.1-.11.11.05.02.07.06.09.13l.03.13h-.12c-.02-.02-.02-.07-.04-.13-.02-.05-.04-.07-.11-.07h-.05l-.02.22zm.02-.3h.06c.07 0 .1-.01.1-.07 0-.05-.03-.07-.1-.07h-.07v.14h.01z"/></svg>'
                        ],
                        'arduino-ide' => [
                            'slug' => 'arduino-ide',
                            'accent' => 'text-teal-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(0,151,157,0.65)]" viewBox="0 0 24 24" fill="#00979D"><path d="M23.82 12a5.78 5.78 0 0 0-5.88-5.67c-.29 0-.6.02-.9.05-2.52.37-4.2 2.18-5.13 3.57-.95-1.39-2.64-3.2-5.14-3.57-.3-.03-.6-.05-.9-.05A5.78 5.78 0 0 0 0 12a5.78 5.78 0 0 0 5.87 5.67c.3 0 .6-.02.92-.06 2.52-.36 4.2-2.17 5.14-3.56.95 1.39 2.63 3.2 5.14 3.57.31.03.6.05.91.05A5.78 5.78 0 0 0 23.82 12zM6.48 15.6c-.2.04-.43.04-.63.04A3.77 3.77 0 0 1 2 11.98a3.78 3.78 0 0 1 3.86-3.66c.2 0 .42.02.63.04 2.37.35 3.82 2.67 4.31 3.62-.5.95-1.95 3.3-4.31 3.62zm13-3.6c.49-.93 1.94-3.27 4.31-3.62.2-.04.42-.04.62-.04A3.76 3.76 0 0 1 21.8 12a3.78 3.78 0 0 1-3.86 3.66c-.2 0-.42-.02-.62-.04-2.36-.35-3.82-2.69-4.31-3.62zm-8.79.59h3.54v-1.16H4.22v1.16zm14.13 0h1.19v-1.16h-1.2v-1.19H17.2v1.2H16v1.15h1.2v1.18h1.15V12.6zM24 7.06c0 .3-.22.51-.53.51a.51.51 0 0 1-.53-.5c0-.28.24-.52.53-.52.31 0 .53.22.53.51zm-.91 0c0 .22.16.4.4.4.22 0 .38-.18.38-.4s-.16-.4-.38-.4c-.24-.02-.4.16-.4.4zm.3.26h-.1V6.8l.2-.01c.09 0 .14.01.18.03.04.02.06.06.06.11 0 .06-.04.1-.11.11.05.02.07.06.09.13l.03.13h-.12c-.02-.02-.02-.07-.04-.13-.02-.05-.04-.07-.11-.07h-.05l-.02.22zm.02-.3h.06c.07 0 .1-.01.1-.07 0-.05-.03-.07-.1-.07h-.07v.14h.01z"/></svg>'
                        ],
                        'arduinoide' => [
                            'slug' => 'arduino-ide',
                            'accent' => 'text-teal-400',
                            'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14 drop-shadow-[0_0_14px_rgba(0,151,157,0.65)]" viewBox="0 0 24 24" fill="#00979D"><path d="M23.82 12a5.78 5.78 0 0 0-5.88-5.67c-.29 0-.6.02-.9.05-2.52.37-4.2 2.18-5.13 3.57-.95-1.39-2.64-3.2-5.14-3.57-.3-.03-.6-.05-.9-.05A5.78 5.78 0 0 0 0 12a5.78 5.78 0 0 0 5.87 5.67c.3 0 .6-.02.92-.06 2.52-.36 4.2-2.17 5.14-3.56.95 1.39 2.63 3.2 5.14 3.57.31.03.6.05.91.05A5.78 5.78 0 0 0 23.82 12zM6.48 15.6c-.2.04-.43.04-.63.04A3.77 3.77 0 0 1 2 11.98a3.78 3.78 0 0 1 3.86-3.66c.2 0 .42.02.63.04 2.37.35 3.82 2.67 4.31 3.62-.5.95-1.95 3.3-4.31 3.62zm13-3.6c.49-.93 1.94-3.27 4.31-3.62.2-.04.42-.04.62-.04A3.76 3.76 0 0 1 21.8 12a3.78 3.78 0 0 1-3.86 3.66c-.2 0-.42-.02-.62-.04-2.36-.35-3.82-2.69-4.31-3.62zm-8.79.59h3.54v-1.16H4.22v1.16zm14.13 0h1.19v-1.16h-1.2v-1.19H17.2v1.2H16v1.15h1.2v1.18h1.15V12.6zM24 7.06c0 .3-.22.51-.53.51a.51.51 0 0 1-.53-.5c0-.28.24-.52.53-.52.31 0 .53.22.53.51zm-.91 0c0 .22.16.4.4.4.22 0 .38-.18.38-.4s-.16-.4-.38-.4c-.24-.02-.4.16-.4.4zm.3.26h-.1V6.8l.2-.01c.09 0 .14.01.18.03.04.02.06.06.06.11 0 .06-.04.1-.11.11.05.02.07.06.09.13l.03.13h-.12c-.02-.02-.02-.07-.04-.13-.02-.05-.04-.07-.11-.07h-.05l-.02.22zm.02-.3h.06c.07 0 .1-.01.1-.07 0-.05-.03-.07-.1-.07h-.07v.14h.01z"/></svg>'
                        ]
                    ];
                @endphp

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4 pt-3">
                    @forelse ($skills as $index => $skill)
                        @php
                            $key = strtolower(trim($skill->name));
                            $cleanKey = preg_replace('/[^a-z0-9]/', '', $key);
                            $conf = $techConfigs[$key] ?? $techConfigs[$cleanKey] ?? [
                                'slug' => 'default',
                                'accent' => 'text-[#A5B698]',
                                'icon' => '<svg class="w-12 h-12 sm:w-14 sm:h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>'
                            ];
                            $slug = $conf['slug'] ?? \Illuminate\Support\Str::slug($key);
                            $waveClass = 'butter-wave-' . (($index % 3) + 1);
                        @endphp

                        <div class="butter-card butter-card-{{ $slug }} {{ $waveClass }} border p-4 sm:p-5 flex flex-col justify-between items-center text-center min-h-[210px] sm:min-h-[230px] shadow-xl group reveal-scale reveal-delay-{{ ($index % 5) + 1 }}"
                             data-skill-index="{{ $index }}">
                            
                            {{-- Top Meta Badges --}}
                            <div class="w-full flex items-center justify-between gap-1 text-[10px] font-bold">
                                <span class="px-2 py-0.5 rounded-full butter-badge-{{ $slug }} truncate border">
                                    {{ $skill->level ?? 'Skill' }}
                                </span>
                                <span class="font-mono butter-card-num text-slate-500 text-[10px]">
                                    0{{ $index + 1 }}
                                </span>
                            </div>

                            {{-- Center 3D Brand Logo with Floating Depth --}}
                            <div class="butter-card-content py-2.5 flex items-center justify-center">
                                <div class="butter-card-logo">
                                    {!! $conf['icon'] !!}
                                </div>
                            </div>

                            {{-- Bottom Title & Category --}}
                            <div class="w-full pt-2 border-t border-white/5">
                                <h3 class="text-xs sm:text-sm font-extrabold butter-card-title text-white group-hover:{{ $conf['accent'] }} transition-colors truncate">
                                    {{ $skill->name }}
                                </h3>
                                <span class="text-[10px] sm:text-[11px] butter-card-desc text-slate-400 font-medium truncate block">
                                    {{ $skill->category ?? 'Tech Stack' }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-slate-500 text-sm">
                            Belum ada keahlian teknis yang ditambahkan.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>

    {{-- === 4. PROJECTS SECTION (#project) === --}}
    <section id="project" class="relative py-16 sm:py-24 bg-[#191919] border-t border-[#353535] overflow-hidden">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-8 sm:mb-12 reveal-init">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#20251d] text-[#A5B698] border border-[#444f3d] mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698]"></span>
                    Portofolio Karya
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#F0EEE8] tracking-tight">
                    Karya & Proyek Terpilih
                </h2>
                <p class="text-[#929292] text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Kumpulan aplikasi web dan proyek yang telah saya bangun dengan fokus pada fungsionalitas dan estetika.
                </p>
            </div>

            {{-- Category Filter Pill --}}
            <div class="flex justify-center mb-8 sm:mb-12 reveal-fade reveal-delay-1">
                <button type="button" class="px-6 py-2.5 rounded-full text-xs font-extrabold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] shadow-md shadow-black/30 transition">
                    Semua Proyek
                </button>
            </div>

            {{-- Dynamic Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                
                @forelse ($projects as $project)
                    <div class="dark-glass-card rounded-2xl overflow-hidden border border-[#353535] hover:border-[#A5B698]/40 transition duration-300 flex flex-col justify-between reveal-init reveal-delay-{{ ($loop->index % 3) + 1 }}">
                        <div>
                            {{-- Image Header with Clickable Zoom Preview --}}
                            <div class="relative h-48 sm:h-52 w-full overflow-hidden bg-[#242424] {{ $project->image_url ? 'cursor-pointer group/img' : '' }}"
                                 @if($project->image_url)
                                     data-img="{{ $project->image_url }}"
                                     data-title="{{ $project->title }}"
                                     data-desc="{{ $project->description }}"
                                     data-demo="{{ $project->demo_link ? (Str::startsWith($project->demo_link, ['http://', 'https://']) ? $project->demo_link : 'https://' . $project->demo_link) : '' }}"
                                     data-github="{{ $project->github_link ? (Str::startsWith($project->github_link, ['http://', 'https://']) ? $project->github_link : 'https://' . $project->github_link) : '' }}"
                                     onclick="openProjectModalFromElement(this)"
                                     title="Klik untuk melihat gambar penuh"
                                 @endif
                            >
                                @if($project->image_url)
                                     <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                                    <div class="absolute inset-0 bg-[#191919]/50 opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="project-preview-pill px-3.5 py-1.5 rounded-full text-xs font-bold shadow-xl flex items-center gap-1.5 transform translate-y-2 group-hover/img:translate-y-0 transition-transform duration-300">
                                            <svg class="w-4 h-4 project-preview-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path></svg>
                                            <span>Lihat Gambar Penuh</span>
                                        </span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#929292] bg-[#242424] font-bold text-xs">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-5 sm:p-6">
                                <h3 class="text-base sm:text-lg font-bold text-[#F0EEE8] mb-2 leading-snug">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-xs text-[#929292] mb-2 leading-relaxed line-clamp-3">
                                    {{ $project->description }}
                                </p>
                            </div>
                        </div>

                        {{-- Footer Actions / Buttons --}}
                        <div class="px-5 sm:px-6 pb-5 pt-3 flex items-center gap-2.5 border-t border-[#353535] mt-auto">
                            @if($project->demo_link)
                                <a href="{{ Str::startsWith($project->demo_link, ['http://', 'https://']) ? $project->demo_link : 'https://' . $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] shadow-md shadow-[#758268]/20 transition-all duration-200 hover:-translate-y-0.5">
                                    <span>Kunjungi Web</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            @endif

                            @if($project->github_link)
                                <a href="{{ Str::startsWith($project->github_link, ['http://', 'https://']) ? $project->github_link : 'https://' . $project->github_link }}" target="_blank" rel="noopener noreferrer" class="{{ $project->demo_link ? 'px-3.5' : 'flex-1' }} py-2.5 inline-flex items-center justify-center gap-2 rounded-xl text-xs font-bold text-[#F0EEE8] hover:text-white bg-[#242424] hover:bg-[#2c2c2c] border border-[#353535] hover:border-[#758268]/50 shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                    <span>GitHub</span>
                                </a>
                            @endif

                            @if(!$project->demo_link && !$project->github_link)
                                <div class="w-full py-2.5 inline-flex items-center justify-center gap-2 rounded-xl text-xs font-semibold text-[#929292] bg-[#242424] border border-[#353535]">
                                    <span>Proyek Pribadi / Portofolio</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="dark-glass-card rounded-2xl overflow-hidden border border-[#353535] hover:border-[#A5B698]/40 transition duration-300 flex flex-col justify-between reveal-init reveal-delay-1">
                        <div>
                            <div class="relative h-48 sm:h-52 w-full overflow-hidden bg-[#242424] cursor-pointer group/img"
                                 data-img="{{ asset('images/foto-saya.jpg') }}"
                                 data-title="Website E Commerce Tote Bag Art Terra"
                                 data-desc="Website Ini adalah E commerce yang menjual tote bag ramah lingkungan"
                                 data-demo=""
                                 data-github="https://github.com"
                                 onclick="openProjectModalFromElement(this)"
                                 title="Klik untuk melihat gambar penuh"
                            >
                                <img src="{{ asset('images/foto-saya.jpg') }}" alt="Website E Commerce Tote Bag Art Terra" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                                <div class="absolute inset-0 bg-[#191919]/50 opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <span class="project-preview-pill px-3.5 py-1.5 rounded-full text-xs font-bold shadow-xl flex items-center gap-1.5 transform translate-y-2 group-hover/img:translate-y-0 transition-transform duration-300">
                                        <svg class="w-4 h-4 project-preview-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path></svg>
                                        <span>Lihat Gambar Penuh</span>
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 sm:p-6">
                                <h3 class="text-base sm:text-lg font-bold text-[#F0EEE8] mb-2">
                                    Website E Commerce Tote Bag Art Terra
                                </h3>
                                <p class="text-xs text-[#929292] mb-2 leading-relaxed">
                                    Website Ini adalah E commerce yang menjual tote bag ramah lingkungan
                                </p>
                            </div>
                        </div>

                        <div class="px-5 sm:px-6 pb-5 pt-3 flex items-center gap-2.5 border-t border-[#353535] mt-auto">
                            <a href="#" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] shadow-md shadow-[#758268]/20 transition">
                                <span>Kunjungi Web</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            <a href="https://github.com" target="_blank" class="px-3.5 py-2.5 inline-flex items-center justify-center gap-2 rounded-xl text-xs font-bold text-[#F0EEE8] hover:text-white bg-[#242424] hover:bg-[#2c2c2c] border border-[#353535] hover:border-[#A5B698]/50 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                <span>GitHub</span>
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- Modal Preview Foto Proyek Fullscreen -->
            <div id="project-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/85 backdrop-blur-md p-4 transition-all duration-300" onclick="closeProjectModal()">
                <div class="relative max-w-5xl w-full p-2" onclick="event.stopPropagation()">
                    <div class="overflow-hidden rounded-2xl border border-[#353535] bg-[#191919] shadow-2xl relative">
                        <button type="button" onclick="closeProjectModal()" class="absolute top-3 right-3 z-30 w-8 h-8 rounded-full bg-[#242424] hover:bg-[#2c2c2c] text-[#929292] hover:text-[#F0EEE8] border border-[#353535] flex items-center justify-center transition shadow-lg" title="Tutup">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        {{-- Image Display Area --}}
                        <div class="max-h-[72vh] overflow-auto flex items-center justify-center p-3 bg-[#191919]">
                            <img id="project-modal-img" src="" alt="Preview Proyek" class="w-auto h-auto max-w-full max-h-[68vh] object-contain rounded-xl shadow-lg">
                        </div>
                        {{-- Bottom Info & Quick Action Bar --}}
                        <div class="p-4 sm:p-5 bg-[#242424] border-t border-[#353535] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 id="project-modal-title" class="text-base sm:text-lg font-bold text-[#F0EEE8] mb-1 truncate"></h3>
                                <p id="project-modal-desc" class="text-xs sm:text-sm text-[#929292] leading-relaxed"></p>
                            </div>
                            <div class="flex items-center gap-2.5 shrink-0">
                                <a id="project-modal-demo" href="#" target="_blank" rel="noopener noreferrer" class="hidden px-4 py-2.5 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] shadow-md shadow-[#758268]/20 transition flex items-center gap-1.5">
                                    <span>Kunjungi Web</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                <a id="project-modal-github" href="#" target="_blank" rel="noopener noreferrer" class="hidden px-3.5 py-2.5 rounded-xl text-xs font-bold text-[#F0EEE8] hover:text-white bg-[#191919] hover:bg-[#2c2c2c] border border-[#353535] hover:border-[#A5B698]/50 transition flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                    <span>GitHub</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openProjectModalFromElement(el) {
                    const imgUrl = el.getAttribute('data-img');
                    const title = el.getAttribute('data-title');
                    const desc = el.getAttribute('data-desc');
                    const demoUrl = el.getAttribute('data-demo');
                    const githubUrl = el.getAttribute('data-github');
                    openProjectModal(imgUrl, title, desc, demoUrl, githubUrl);
                }

                function openProjectModal(imgUrl, title, desc, demoUrl, githubUrl) {
                    document.getElementById('project-modal-img').src = imgUrl;
                    document.getElementById('project-modal-title').innerText = title;
                    document.getElementById('project-modal-desc').innerText = desc || '';

                    const demoBtn = document.getElementById('project-modal-demo');
                    if (demoUrl) {
                        demoBtn.href = demoUrl;
                        demoBtn.classList.remove('hidden');
                    } else {
                        demoBtn.classList.add('hidden');
                    }

                    const ghBtn = document.getElementById('project-modal-github');
                    if (githubUrl) {
                        ghBtn.href = githubUrl;
                        ghBtn.classList.remove('hidden');
                    } else {
                        ghBtn.classList.add('hidden');
                    }

                    document.getElementById('project-modal').classList.remove('hidden');
                }

                function closeProjectModal() {
                    document.getElementById('project-modal').classList.add('hidden');
                }

                window.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        closeProjectModal();
                        const c = document.getElementById('cert-modal');
                        if (c) c.classList.add('hidden');
                    }
                });
            </script>
        </div>
    </section>

    {{-- === 5. EXPERIENCE & TIMELINE SECTION (#pengalaman) === --}}
    <section id="pengalaman" class="relative py-16 sm:py-24 bg-[#191919] border-t border-[#353535]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-16 reveal-init">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#20251d] text-[#A5B698] border border-[#444f3d] mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698]"></span>
                    Perjalanan Karier
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#F0EEE8] tracking-tight">
                    Riwayat Pendidikan & Organisasi
                </h2>
                <p class="text-[#929292] text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Jejak pembelajaran dan keaktifan organisasi yang membentuk keahlian teknis saya.
                </p>
            </div>

            {{-- Professional Clean Timeline --}}
            <div class="max-w-4xl mx-auto relative pl-6 sm:pl-8 space-y-6 sm:space-y-8">
                {{-- Clean Subtle Vertical Rail --}}
                <div class="absolute left-2 sm:left-3 top-3 bottom-3 w-px bg-[#353535]"></div>

                @forelse ($experiences as $exp)
                    <div class="relative reveal-init reveal-delay-{{ ($loop->index % 3) + 1 }}">
                        {{-- Minimal Milestone Dot --}}
                        <div class="absolute -left-[22px] sm:-left-[26px] top-5 w-3 h-3 rounded-full bg-[#A5B698] ring-4 ring-[#191919]"></div>
                        <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-[#353535] hover:border-[#A5B698]/40 transition duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-[#20251d] text-[#A5B698] border border-[#444f3d]">
                                    {{ $exp->type }}
                                </span>
                                <span class="text-xs font-semibold text-[#929292] flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ $exp->period }}</span>
                                </span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-[#F0EEE8]">
                                {{ $exp->title }}
                            </h3>
                            @if($exp->organization)
                                <h4 class="text-xs sm:text-sm font-semibold text-[#929292] mb-2">
                                    {{ $exp->organization }}
                                </h4>
                            @endif
                            @if($exp->description)
                                <p class="text-xs text-[#929292] leading-relaxed">
                                    {{ $exp->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="relative reveal-init reveal-delay-1">
                        {{-- Minimal Milestone Dot --}}
                        <div class="absolute -left-[22px] sm:-left-[26px] top-5 w-3 h-3 rounded-full bg-[#A5B698] ring-4 ring-[#191919]"></div>
                        <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-[#353535] hover:border-[#A5B698]/40 transition duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-[#20251d] text-[#A5B698] border border-[#444f3d]">
                                    PENDIDIKAN
                                </span>
                                <span class="text-xs font-semibold text-[#929292] flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>2024 – 2026</span>
                                </span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-[#F0EEE8]">
                                Web Developer
                            </h3>
                            <h4 class="text-xs sm:text-sm font-semibold text-[#929292] mb-2">
                                Organisasi
                            </h4>
                            <p class="text-xs text-[#929292] leading-relaxed">
                                masih berlangsung sampai sekarang
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- === 6. CERTIFICATIONS SECTION (#sertifikat) === --}}
    <section id="sertifikat" class="relative py-16 sm:py-24 bg-[#191919] border-t border-[#353535]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-16 reveal-init">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#20251d] text-[#A5B698] border border-[#444f3d] mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698]"></span>
                    Sertifikasi & Lisensi
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#F0EEE8] tracking-tight">
                    Pencapaian & Bukti Kompetensi
                </h2>
                <p class="text-[#929292] text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Bukti keahlian dan kompetensi resmi yang diakui oleh lembaga pendidikan dan industri.
                </p>
            </div>

            {{-- Certificate Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-5xl mx-auto">
                @forelse ($certificates as $cert)
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-[#353535] hover:border-[#A5B698]/40 transition duration-300 flex flex-col sm:flex-row items-start gap-4 sm:gap-5 reveal-scale reveal-delay-{{ ($loop->index % 2) + 1 }}">
                        @if($cert->image_url)
                            <div class="w-full sm:w-28 h-40 sm:h-24 rounded-xl overflow-hidden bg-[#242424] border border-[#353535] shrink-0 cursor-pointer group/img" onclick="openCertModal('{{ $cert->image_url }}', '{{ $cert->title }}')">
                                <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-cover group-hover/img:scale-105 transition duration-300">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-xl bg-[#191919] border border-[#353535] flex items-center justify-center text-[#A5B698] shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2 0h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                        @endif
                        <div class="flex-1 w-full">
                            <span class="text-[10px] font-extrabold uppercase text-[#A5B698] tracking-wider">{{ $cert->type }}</span>
                            <h3 class="text-base sm:text-lg font-bold text-[#F0EEE8] mt-1">{{ $cert->title }}</h3>
                            <p class="text-xs text-[#929292] mt-1 mb-3">{{ $cert->issuer }}</p>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="inline-block text-[11px] font-semibold text-[#929292] bg-[#242424] border border-[#353535] px-3 py-1 rounded-full">
                                    Tahun {{ $cert->year }}
                                </span>
                                @if($cert->image_url)
                                    <button type="button" onclick="openCertModal('{{ $cert->image_url }}', '{{ $cert->title }}')" class="text-xs font-bold text-[#A5B698] hover:text-[#F0EEE8] transition flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        <span>Lihat Sertifikat</span>
                                    </button>
                                @endif
                                @if($cert->link)
                                    <a href="{{ $cert->link }}" target="_blank" class="text-xs font-bold text-[#A5B698] hover:text-[#F0EEE8] transition flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                        <span>Kredensial</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-[#353535] hover:border-[#A5B698]/40 transition duration-300 flex items-start gap-4 reveal-scale reveal-delay-1">
                        <div class="w-12 h-12 rounded-xl bg-[#191919] border border-[#353535] flex items-center justify-center text-[#A5B698] shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2 0h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold uppercase text-[#A5B698] tracking-wider">SERTIFIKASI KOMPETENSI</span>
                            <h3 class="text-base sm:text-lg font-bold text-[#F0EEE8] mt-1">Junior Web Developer</h3>
                            <p class="text-xs text-[#929292] mt-1 mb-3">SMK Negeri 1 Bangsri & Partners</p>
                            <span class="inline-block text-[11px] font-semibold text-[#929292] bg-[#242424] border border-[#353535] px-3 py-1 rounded-full">
                                Tahun 2024
                            </span>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Public Modal Preview Foto Sertifikat -->
            <div id="cert-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/85 backdrop-blur-md p-4" onclick="this.classList.add('hidden')">
                <div class="relative max-w-4xl w-full p-2" onclick="event.stopPropagation()">
                    <button type="button" onclick="document.getElementById('cert-modal').classList.add('hidden')" class="absolute top-4 right-4 z-30 w-8 h-8 rounded-full bg-[#242424] hover:bg-[#2c2c2c] text-[#929292] hover:text-[#F0EEE8] border border-[#353535] flex items-center justify-center transition shadow-lg" title="Tutup">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <img id="cert-modal-img" src="" alt="Sertifikat" class="w-full h-auto max-h-[85vh] object-contain rounded-2xl border border-[#353535] shadow-2xl">
                    <p id="cert-modal-title" class="text-center text-sm font-bold text-white mt-3"></p>
                </div>
            </div>

            <script>
                function openCertModal(imgUrl, title) {
                    document.getElementById('cert-modal-img').src = imgUrl;
                    document.getElementById('cert-modal-title').innerText = title;
                    document.getElementById('cert-modal').classList.remove('hidden');
                }
            </script>
        </div>
    </section>

    {{-- === 7. CONTACT SECTION (#contact) === --}}
    <section id="contact" class="relative py-16 sm:py-24 bg-[#191919] border-t border-[#353535]">
        {{-- Subtle ambient grid background --}}
        <div class="absolute inset-0 bg-[radial-gradient(#353535_1px,transparent_1px)] [background-size:24px_24px] opacity-20 pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-16 reveal-init">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[#20251d] text-[#A5B698] border border-[#444f3d] mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#A5B698]"></span>
                    Hubungi Saya
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-[#F0EEE8] tracking-tight">
                    Mari Terhubung & Berkolaborasi
                </h2>
                <p class="text-[#929292] text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Punya ide proyek, penawaran kerja sama, atau sekadar ingin berdiskusi? Pintu saya selalu terbuka!
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch max-w-6xl mx-auto">
                
                {{-- Left Column: Interactive Contact Command Center --}}
                <div class="contact-card lg:col-span-5 flex flex-col justify-between h-full p-6 sm:p-8 rounded-3xl bg-[#242424] border border-[#353535] shadow-xl reveal-left reveal-delay-1">
                    <div>
                        {{-- Availability status pill --}}
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span>Terbuka Untuk Peluang Baru</span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-black text-[#F0EEE8] tracking-tight mb-2">
                            Siap Memulai Proyek Anda?
                        </h3>
                        <p class="text-xs sm:text-sm text-[#929292] leading-relaxed mb-6">
                            Saya selalu antusias berdiskusi seputar pembuatan website modern, sistem informasi, maupun kolaborasi pengembangan software.
                        </p>

                        {{-- Contact Items List --}}
                        <div class="space-y-3.5">
                            
                            {{-- Email item with Copy action --}}
                            <div class="contact-subcard p-3.5 rounded-2xl bg-[#191919] border border-[#353535] hover:border-[#A5B698]/40 transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-[#191919] border border-[#353535] flex items-center justify-center text-[#A5B698] shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-[11px] font-medium text-[#929292]">Email Resmi</span>
                                        <a href="mailto:{{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}" class="text-xs sm:text-sm font-bold text-[#F0EEE8] hover:text-[#A5B698] transition truncate block">
                                            {{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}
                                        </a>
                                    </div>
                                </div>
                                <button type="button" onclick="copyContactEmail('{{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}')" id="copy-email-btn" title="Salin Email" class="contact-badge p-2 rounded-xl bg-[#242424] border border-[#353535] hover:border-[#A5B698]/50 text-[#929292] hover:text-[#A5B698] transition shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                            </div>

                            {{-- WhatsApp item with direct chat action --}}
                            <div class="contact-subcard p-3.5 rounded-2xl bg-[#191919] border border-[#353535] hover:border-emerald-500/40 transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-[11px] font-medium text-[#929292]">Telepon / WhatsApp</span>
                                        <a href="{{ $profile->whatsapp_url ?? 'https://wa.me/6289639685566' }}" target="_blank" class="text-xs sm:text-sm font-bold text-[#F0EEE8] hover:text-emerald-400 transition truncate block">
                                            {{ $profile->phone ?? '+62 896-3968-5566' }}
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ $profile->whatsapp_url ?? 'https://wa.me/6289639685566' }}" target="_blank" class="px-2.5 py-1.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 hover:bg-emerald-500/20 text-[11px] font-bold transition shrink-0 flex items-center gap-1">
                                    <span>Chat</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>

                            {{-- Location item --}}
                            <div class="contact-subcard p-3.5 rounded-2xl bg-[#191919] border border-[#353535] flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#191919] border border-[#353535] flex items-center justify-center text-[#A5B698] shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-[11px] font-medium text-[#929292]">Domisili</span>
                                        <span class="text-xs sm:text-sm font-bold text-[#F0EEE8]">
                                            {{ $profile->location ?? 'Jepara, Jawa Tengah' }}
                                        </span>
                                    </div>
                                </div>
                                <span class="contact-badge text-[10px] font-bold px-2.5 py-1 rounded-lg bg-[#242424] border border-[#353535] text-[#929292]">
                                    WIB (UTC+7)
                                </span>
                            </div>

                        </div>
                    </div>


                </div>

                {{-- Right Column: Modern High-Converting Contact Form --}}
                <div class="lg:col-span-7 flex flex-col h-full reveal-right reveal-delay-2">
                    @if(session('contact_success'))
                        <div class="mb-4 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-bold flex items-center gap-2.5">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>{{ session('contact_success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-500 text-sm font-semibold">
                            <div class="flex items-center gap-2 mb-1.5 text-rose-600 dark:text-rose-300 font-bold">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <span>Mohon periksa data formulir:</span>
                            </div>
                            <ul class="list-disc list-inside text-xs space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-card p-6 sm:p-8 rounded-3xl bg-[#242424] border border-[#353535] shadow-xl flex-1 flex flex-col justify-between">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-[#F0EEE8] mb-1">
                                    Kirim Pesan
                                </h3>
                                <p class="text-xs text-[#929292]">
                                    Isi formulir di bawah ini dan saya akan merespons ke email Anda sesegera mungkin.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-[#F0EEE8] mb-1.5">Nama Lengkap <span class="text-[#A5B698]">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" required minlength="2" class="contact-input w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292] focus:outline-none focus:ring-2 focus:ring-[#A5B698]/20 focus:border-[#A5B698] transition-all" placeholder="Masukkan nama Anda">
                                    @error('name')
                                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#F0EEE8] mb-1.5">Alamat Email <span class="text-[#A5B698]">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Format email wajib menggunakan domain @gmail.com (contoh: nama@gmail.com)" class="contact-input w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292] focus:outline-none focus:ring-2 focus:ring-[#A5B698]/20 focus:border-[#A5B698] transition-all" placeholder="nama@gmail.com">
                                    <p class="text-[11px] text-[#929292] mt-1">Wajib menggunakan akun <span class="text-[#A5B698] font-semibold">@gmail.com</span></p>
                                    @error('email')
                                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#F0EEE8] mb-1.5">Subjek / Topik</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="contact-input w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292] focus:outline-none focus:ring-2 focus:ring-[#A5B698]/20 focus:border-[#A5B698] transition-all" placeholder="e.g. Penawaran Proyek Website, Tanya Jawab, dll.">
                                @error('subject')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#F0EEE8] mb-1.5">Pesan Anda <span class="text-[#A5B698]">*</span></label>
                                <textarea name="message" rows="3" required minlength="5" class="contact-input w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292] focus:outline-none focus:ring-2 focus:ring-[#A5B698]/20 focus:border-[#A5B698] transition-all leading-relaxed resize-none" placeholder="Ceritakan kebutuhan proyek, timeline, atau detail pesan Anda di sini...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="contact-divider pt-6 mt-6 border-t border-[#353535] flex flex-col sm:flex-row items-center justify-between gap-4">
                            <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl font-bold text-sm text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] shadow-md shadow-black/25 transition-all duration-200 hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                                <span>Kirim Pesan Sekarang</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            <span class="text-[11px] text-[#929292] flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-[#929292]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <span>Pesan terkirim aman ke admin</span>
                            </span>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>

    <script>
        function copyContactEmail(email) {
            navigator.clipboard.writeText(email).then(() => {
                const btn = document.getElementById('copy-email-btn');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<span class="text-xs font-bold text-[#A5B698] px-1">Tersalin!</span>';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            }).catch(() => {
                prompt("Salin alamat email:", email);
            });
        }
    </script>

    {{-- === 8. FOOTER === --}}
    <footer class="py-8 bg-[#141414] border-t border-[#353535] text-center text-xs text-[#929292]">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span>© 2026 {{ $profile->name ?? 'Adristy Akiko Yukinata' }}. All rights reserved.</span>
            <div class="flex items-center gap-6">
                <a href="#home" class="hover:text-[#A5B698] transition flex items-center gap-1">
                    <span>Kembali ke Atas</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </a>
            </div>
        </div>
    </footer>

</x-landing-layout>