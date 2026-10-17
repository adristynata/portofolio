<x-landing-layout>

    {{-- Navbar --}}
    @include('landing.navbar')
    
    {{-- === 1. HERO SECTION (#home) === --}}
    <section id="home" class="relative min-h-screen flex items-center justify-center pt-24 pb-12 sm:pt-24 sm:pb-16 overflow-hidden bg-[#070b19]">
        {{-- Background Glow & Grid Effects --}}
        <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:32px_32px] opacity-25"></div>
        <div class="absolute top-1/4 -right-20 w-80 sm:w-96 h-80 sm:h-96 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 -left-20 w-80 sm:w-96 h-80 sm:h-96 bg-purple-600/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-4 sm:py-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
                
                {{-- Left Side: Texts & Action Buttons --}}
                <div class="lg:col-span-7 flex flex-col gap-4 sm:gap-5 text-left">
                    
                    {{-- Pill Badge --}}
                    <div>
                        <span class="inline-flex items-center gap-2 px-3.5 sm:px-4 py-1.5 rounded-full text-xs font-bold tracking-wide bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 backdrop-blur-md">
                            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                            <span>Fullstack Developer</span>
                        </span>
                    </div>

                    {{-- Main Title --}}
                    <h1 class="text-3xl sm:text-5xl lg:text-5xl xl:text-6xl font-black text-white leading-tight tracking-tight">
                        Halo, Saya <br>
                        <span class="text-gradient-cyan-purple drop-shadow-sm">{{ $profile->name ?? 'Adristy Akiko Yukinata' }}</span>
                    </h1>

                    {{-- Subheading --}}
                    <h2 class="text-lg sm:text-xl font-bold text-slate-300">
                        {{ $profile->role_title ?? 'Fullstack Developer' }}
                    </h2>

                    {{-- Bio / Intro Paragraph --}}
                    <p class="text-sm sm:text-base text-slate-400 font-normal leading-relaxed max-w-2xl">
                        {{ $profile->hero_bio ?? 'Saya adalah Junior Web Developer sekaligus Software Engineering dari SMK Negeri 1 Bangsri yang berfokus pada pengembangan web modern, responsif, dan berperforma tinggi.' }}
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-1 w-full sm:w-auto">
                        <a href="#project" class="inline-flex items-center justify-center gap-2 px-6 sm:px-7 py-3.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 shadow-lg shadow-cyan-500/20 hover:shadow-cyan-500/35 hover:-translate-y-0.5 transition-all duration-200 text-center">
                            <span>Jelajahi Proyek</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </a>
                        <a href="#contact" class="inline-flex items-center justify-center gap-2 px-6 sm:px-7 py-3.5 rounded-xl font-semibold text-sm text-slate-200 bg-slate-900/80 border border-slate-700/80 hover:border-cyan-500/50 hover:text-white hover:bg-slate-800 transition-all duration-200 text-center">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>Hubungi Saya</span>
                        </a>
                    </div>

                    {{-- Dynamic Social Media Links (Editable via Admin Dashboard) --}}
                    <div class="flex items-center gap-3 pt-2 sm:pt-3">
                        @if(!empty($profile->github_url))
                            <a href="{{ $profile->github_url }}" target="_blank" title="GitHub" class="w-10 h-10 rounded-full bg-slate-900/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-500/50 hover:scale-110 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                            </a>
                        @endif

                        @if(!empty($profile->linkedin_url))
                            <a href="{{ $profile->linkedin_url }}" target="_blank" title="LinkedIn" class="w-10 h-10 rounded-full bg-slate-900/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-500/50 hover:scale-110 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                            </a>
                        @endif

                        @if(!empty($profile->instagram_url))
                            <a href="{{ $profile->instagram_url }}" target="_blank" title="Instagram" class="w-10 h-10 rounded-full bg-slate-900/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-500/50 hover:scale-110 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                        @endif

                        @if(!empty($profile->whatsapp_url))
                            <a href="{{ $profile->whatsapp_url }}" target="_blank" title="WhatsApp" class="w-10 h-10 rounded-full bg-slate-900/90 border border-slate-700/80 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-500/50 hover:scale-110 transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            </a>
                        @endif
                    </div>

                </div>

                {{-- Right Side: Seamless Profile Cutout with 3D Tech Orbs & Arch Backdrop (Matching User Reference) --}}
                <div class="lg:col-span-5 flex justify-center mt-6 lg:mt-0">
                    <div class="relative w-full max-w-[340px] sm:max-w-[400px] lg:max-w-[440px] flex items-center justify-center">
                        
                        {{-- Soft Ambient Glow Behind Backdrop --}}
                        <div class="absolute -inset-6 bg-gradient-to-tr from-cyan-500/15 via-blue-600/10 to-teal-500/15 rounded-full blur-3xl pointer-events-none opacity-80"></div>

                        {{-- Background Geometric Stripe Arch (Matching Reference) --}}
                        <div class="absolute inset-0 -top-6 flex items-center justify-center pointer-events-none z-0">
                            <svg viewBox="0 0 400 420" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[330px] sm:w-[390px] lg:w-[430px] h-auto text-white/20 sm:text-white/25">
                                <line x1="143.4" y1="55" x2="256.6" y2="55" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="116.0" y1="68" x2="284.0" y2="68" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="97.1" y1="81" x2="302.9" y2="81" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="82.7" y1="94" x2="317.3" y2="94" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="71.1" y1="107" x2="328.9" y2="107" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="61.7" y1="120" x2="338.3" y2="120" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="54.1" y1="133" x2="345.9" y2="133" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="47.9" y1="146" x2="352.1" y2="146" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="43.1" y1="159" x2="356.9" y2="159" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="39.4" y1="172" x2="360.6" y2="172" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="36.9" y1="185" x2="363.1" y2="185" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="35.4" y1="198" x2="364.6" y2="198" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="35.0" y1="211" x2="365.0" y2="211" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="35.6" y1="224" x2="364.4" y2="224" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="37.2" y1="237" x2="362.8" y2="237" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="39.9" y1="250" x2="360.1" y2="250" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="43.7" y1="263" x2="356.3" y2="263" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="48.8" y1="276" x2="351.2" y2="276" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="55.1" y1="289" x2="344.9" y2="289" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="63.0" y1="302" x2="337.0" y2="302" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="72.7" y1="315" x2="327.3" y2="315" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="84.7" y1="328" x2="315.3" y2="328" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="99.7" y1="341" x2="300.3" y2="341" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="119.4" y1="354" x2="280.6" y2="354" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                                <line x1="149.2" y1="367" x2="250.8" y2="367" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
                            </svg>
                        </div>

                        {{-- 3D Glossy Floating Orb 1 (Top Left, Background) --}}
                        <div class="absolute -left-2 sm:-left-5 top-14 sm:top-16 w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-full tech-orb-teal pointer-events-none z-0 animate-float-1"></div>

                        {{-- Cutout Photo of Adristy (No Box, Floating) --}}
                        <div class="relative z-10 w-[270px] sm:w-[320px] lg:w-[350px] flex justify-center">
                            <img src="{{ asset('images/adristy_cutout.png') }}" 
                                 alt="{{ $profile->name ?? 'Foto Profil' }}" 
                                 class="w-full h-auto object-contain drop-shadow-[0_20px_40px_rgba(0,0,0,0.7)] select-none transition duration-500 hover:scale-105"
                                 style="mask-image: linear-gradient(to bottom, black 82%, transparent 100%); -webkit-mask-image: linear-gradient(to bottom, black 82%, transparent 100%);">
                        </div>

                        {{-- 3D Glossy Floating Orb 2 (Bottom Right, Foreground) --}}
                        <div class="absolute -right-2 sm:-right-5 bottom-8 sm:bottom-10 w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-full tech-orb-teal pointer-events-none z-20 animate-float-2"></div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- === 2. ABOUT SECTION (#about) === --}}
    <section id="about" class="relative py-16 sm:py-24 bg-[#090e23] border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-14">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Tentang Saya
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Dedikasi Dalam Pengembangan Web
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Mengenal lebih dekat latar belakang, filosofi kerja, dan fokus keahlian saya di dunia software engineering.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                
                {{-- Left Column: Bio & 4 Detail Info Cards --}}
                <div class="lg:col-span-7 flex flex-col gap-6">
                    <h3 class="text-xl sm:text-2xl font-bold text-white">
                        Mengembangkan Solusi Software Berkualitas & Berperforma Tinggi
                    </h3>

                    <p class="text-slate-300 leading-relaxed text-sm sm:text-base whitespace-pre-line">
                        {{ $profile->bio ?? 'Saya adalah junior web developer dari SMK Negeri 1 Bangsri yang passionate dalam menciptakan pengalaman digital yang menarik dan fungsional.' }}
                    </p>

                    {{-- 2x2 Information Grid Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 sm:pt-4">
                        
                        {{-- Card 1: Pendidikan --}}
                        <div class="dark-glass-card p-4 rounded-xl flex items-center gap-3.5 border border-white/10 hover:border-cyan-500/40 transition">
                            <div class="w-10 h-10 rounded-lg bg-blue-500/10 text-cyan-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold">Pendidikan</span>
                                <span class="text-xs sm:text-sm font-bold text-white">{{ $profile->education ?? 'Teknik Informatika / RPL' }}</span>
                            </div>
                        </div>

                        {{-- Card 2: Fokus Utama --}}
                        <div class="dark-glass-card p-4 rounded-xl flex items-center gap-3.5 border border-white/10 hover:border-cyan-500/40 transition">
                            <div class="w-10 h-10 rounded-lg bg-cyan-500/10 text-cyan-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold">Fokus Utama</span>
                                <span class="text-xs sm:text-sm font-bold text-white">{{ $profile->focus ?? 'Web & Backend Dev' }}</span>
                            </div>
                        </div>

                        {{-- Card 3: Email --}}
                        <div class="dark-glass-card p-4 rounded-xl flex items-center gap-3.5 border border-white/10 hover:border-cyan-500/40 transition overflow-hidden">
                            <div class="w-10 h-10 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="overflow-hidden min-w-0">
                                <span class="block text-xs text-slate-400 font-semibold">Email</span>
                                <span class="text-xs sm:text-sm font-bold text-white truncate block" title="{{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}">
                                    {{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}
                                </span>
                            </div>
                        </div>

                        {{-- Card 4: Lokasi --}}
                        <div class="dark-glass-card p-4 rounded-xl flex items-center gap-3.5 border border-white/10 hover:border-cyan-500/40 transition">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold">Lokasi</span>
                                <span class="text-xs sm:text-sm font-bold text-white">{{ $profile->location ?? 'Jepara' }}</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Right Column: 4 Stat Cards --}}
                <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                    
                    {{-- Stat 1 --}}
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800 text-center flex flex-col items-center justify-center hover:border-cyan-500/50 transition">
                        <span class="text-3xl sm:text-4xl font-black text-cyan-400 mb-1">{{ max(1, count($projects)) }}+</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">PROYEK SELESAI</span>
                    </div>

                    {{-- Stat 2 --}}
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800 text-center flex flex-col items-center justify-center hover:border-purple-500/50 transition">
                        <span class="text-3xl sm:text-4xl font-black text-purple-400 mb-1">{{ max(1, count($skills)) }}+</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">SKILL & TOOLS</span>
                    </div>

                    {{-- Stat 3 --}}
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800 text-center flex flex-col items-center justify-center hover:border-pink-500/50 transition">
                        <span class="text-3xl sm:text-4xl font-black text-pink-400 mb-1">{{ max(1, count($certificates)) }}+</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">SERTIFIKASI</span>
                    </div>

                    {{-- Stat 4 --}}
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800 text-center flex flex-col items-center justify-center hover:border-emerald-500/50 transition">
                        <span class="text-3xl sm:text-4xl font-black text-emerald-400 mb-1">100%</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">CLEAN CODE</span>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- === 3. SKILLS SECTION (#skill) === --}}
    <section id="skill" class="relative py-16 sm:py-24 bg-[#070b19]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-14">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Keahlian Teknis
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Teknologi & Stack Unggulan
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Kumpulan bahasa pemrograman, framework, dan tools yang saya gunakan dalam membangun aplikasi modern.
                </p>
            </div>

            {{-- Dynamic Skill Cards Grid (Clean & Modern without Percentages) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @forelse ($skills as $skill)
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800/80 hover:border-cyan-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group">
                        <div class="flex items-center gap-3.5 sm:gap-4">
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 group-hover:scale-110 group-hover:bg-cyan-500/20 group-hover:border-cyan-400/60 transition-all shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-white group-hover:text-cyan-400 transition-colors">
                                    {{ $skill->name }}
                                </h3>
                                <span class="text-xs text-slate-400 font-medium">
                                    {{ $skill->category ?? 'Web Development' }}
                                </span>
                            </div>
                        </div>
                        @if(!empty($skill->level))
                            <span class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900/90 border border-slate-700/80 text-cyan-400 group-hover:border-cyan-500/40 shrink-0">
                                {{ $skill->level }}
                            </span>
                        @endif
                    </div>
                @empty
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800/80 hover:border-cyan-500/50 transition duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-3.5 sm:gap-4">
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Laravel</h3>
                                <span class="text-xs text-slate-400">Backend Development</span>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 border border-slate-700 text-cyan-400">
                            Beginner
                        </span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- === 4. PROJECTS SECTION (#project) === --}}
    <section id="project" class="relative py-16 sm:py-24 bg-[#090e23] border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-8 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Portofolio Karya
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Karya & Proyek Terpilih
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Kumpulan aplikasi web dan proyek yang telah saya bangun dengan fokus pada fungsionalitas dan estetika.
                </p>
            </div>

            {{-- Category Filter Pill --}}
            <div class="flex justify-center mb-8 sm:mb-12">
                <button type="button" class="px-6 py-2.5 rounded-full text-xs font-extrabold text-white bg-cyan-500 shadow-[0_0_20px_rgba(0,240,255,0.4)] transition hover:bg-cyan-400">
                    Semua Proyek
                </button>
            </div>

            {{-- Dynamic Projects Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                
                @forelse ($projects as $project)
                    <div class="dark-glass-card rounded-2xl overflow-hidden border border-slate-800 hover:border-cyan-500/50 transition duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Image Header with Clickable Zoom Preview --}}
                            <div class="relative h-48 sm:h-52 w-full overflow-hidden bg-slate-900 {{ $project->image_url ? 'cursor-pointer group/img' : '' }}"
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
                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold text-white bg-slate-900/85 backdrop-blur-md border border-cyan-500/40 shadow-xl flex items-center gap-1.5 transform translate-y-2 group-hover/img:translate-y-0 transition-transform duration-300">
                                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path></svg>
                                            <span>Lihat Gambar Penuh</span>
                                        </span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-600 bg-slate-900 font-bold text-xs">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-5 sm:p-6">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-2 leading-snug">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-xs text-slate-400 mb-2 leading-relaxed line-clamp-3">
                                    {{ $project->description }}
                                </p>
                            </div>
                        </div>

                        {{-- Footer Actions / Buttons --}}
                        <div class="px-5 sm:px-6 pb-5 pt-3 flex items-center gap-2.5 border-t border-slate-800/60 mt-auto">
                            @if($project->demo_link)
                                <a href="{{ Str::startsWith($project->demo_link, ['http://', 'https://']) ? $project->demo_link : 'https://' . $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 shadow-md shadow-cyan-500/20 transition-all duration-200 hover:-translate-y-0.5">
                                    <span>Kunjungi Web</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            @endif

                            @if($project->github_link)
                                <a href="{{ Str::startsWith($project->github_link, ['http://', 'https://']) ? $project->github_link : 'https://' . $project->github_link }}" target="_blank" rel="noopener noreferrer" class="{{ $project->demo_link ? 'px-3.5' : 'flex-1' }} py-2.5 inline-flex items-center justify-center gap-2 rounded-xl text-xs font-bold text-slate-200 hover:text-white bg-slate-800/90 hover:bg-slate-700 border border-slate-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                    <span>GitHub</span>
                                </a>
                            @endif

                            @if(!$project->demo_link && !$project->github_link)
                                <div class="w-full py-2.5 inline-flex items-center justify-center gap-2 rounded-xl text-xs font-semibold text-slate-400 bg-slate-800/40 border border-slate-800">
                                    <span>Proyek Pribadi / Portofolio</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="dark-glass-card rounded-2xl overflow-hidden border border-slate-800 hover:border-cyan-500/50 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="relative h-48 sm:h-52 w-full overflow-hidden bg-slate-900 cursor-pointer group/img"
                                 data-img="{{ asset('images/foto-saya.jpg') }}"
                                 data-title="Website E Commerce Tote Bag Art Terra"
                                 data-desc="Website Ini adalah E commerce yang menjual tote bag ramah lingkungan"
                                 data-demo=""
                                 data-github="https://github.com"
                                 onclick="openProjectModalFromElement(this)"
                                 title="Klik untuk melihat gambar penuh"
                            >
                                <img src="{{ asset('images/foto-saya.jpg') }}" alt="Website E Commerce Tote Bag Art Terra" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                                <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <span class="px-3.5 py-1.5 rounded-full text-xs font-bold text-white bg-slate-900/85 backdrop-blur-md border border-cyan-500/40 shadow-xl flex items-center gap-1.5 transform translate-y-2 group-hover/img:translate-y-0 transition-transform duration-300">
                                        <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path></svg>
                                        <span>Lihat Gambar Penuh</span>
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 sm:p-6">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-2">
                                    Website E Commerce Tote Bag Art Terra
                                </h3>
                                <p class="text-xs text-slate-400 mb-2 leading-relaxed">
                                    Website Ini adalah E commerce yang menjual tote bag ramah lingkungan
                                </p>
                            </div>
                        </div>

                        <div class="px-5 sm:px-6 pb-5 pt-3 flex items-center gap-2.5 border-t border-slate-800/60 mt-auto">
                            <a href="#" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 shadow-md shadow-cyan-500/20 transition">
                                <span>Kunjungi Web</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            <a href="https://github.com" target="_blank" class="px-3.5 py-2.5 inline-flex items-center justify-center gap-2 rounded-xl text-xs font-bold text-slate-200 hover:text-white bg-slate-800/90 hover:bg-slate-700 border border-slate-700 transition">
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
                    <button type="button" onclick="closeProjectModal()" class="absolute -top-10 right-0 text-slate-300 hover:text-white text-2xl font-bold flex items-center gap-1.5 leading-none transition">
                        <span>&times;</span>
                        <span class="text-sm font-semibold">Tutup</span>
                    </button>
                    <div class="overflow-hidden rounded-2xl border border-slate-700/80 bg-slate-950 shadow-2xl">
                        {{-- Image Display Area --}}
                        <div class="max-h-[72vh] overflow-auto flex items-center justify-center p-3 bg-slate-950/90">
                            <img id="project-modal-img" src="" alt="Preview Proyek" class="w-auto h-auto max-w-full max-h-[68vh] object-contain rounded-xl shadow-lg">
                        </div>
                        {{-- Bottom Info & Quick Action Bar --}}
                        <div class="p-4 sm:p-5 bg-slate-900 border-t border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 id="project-modal-title" class="text-base sm:text-lg font-bold text-white mb-1 truncate"></h3>
                                <p id="project-modal-desc" class="text-xs sm:text-sm text-slate-400 leading-relaxed"></p>
                            </div>
                            <div class="flex items-center gap-2.5 shrink-0">
                                <a id="project-modal-demo" href="#" target="_blank" rel="noopener noreferrer" class="hidden px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 shadow-md shadow-cyan-500/20 transition flex items-center gap-1.5">
                                    <span>Kunjungi Web</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                <a id="project-modal-github" href="#" target="_blank" rel="noopener noreferrer" class="hidden px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-200 hover:text-white bg-slate-800 hover:bg-slate-700 border border-slate-700 transition flex items-center gap-1.5">
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
            </script>
        </div>
    </section>

    {{-- === 5. EXPERIENCE & TIMELINE SECTION (#pengalaman) === --}}
    <section id="pengalaman" class="relative py-16 sm:py-24 bg-[#070b19]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-16">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Perjalanan Karier
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Riwayat Pendidikan & Organisasi
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Jejak pembelajaran dan keaktifan organisasi yang membentuk keahlian teknis saya.
                </p>
            </div>

            {{-- Dynamic Timeline Cards --}}
            <div class="max-w-4xl mx-auto relative pl-4 sm:pl-6 border-l-2 border-cyan-500/40 space-y-6 sm:space-y-8">
                @forelse ($experiences as $exp)
                    <div class="relative">
                        <div class="absolute -left-[23px] sm:-left-[31px] top-4 w-4 h-4 rounded-full bg-cyan-400 border-4 border-[#070b19] shadow-[0_0_10px_#00f0ff]"></div>
                        <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800/80 hover:border-cyan-500/50 transition duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-cyan-500/10 text-cyan-400 border border-cyan-500/30">
                                    {{ $exp->type }}
                                </span>
                                <span class="text-xs font-semibold text-slate-400 flex items-center gap-1">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ $exp->period }}</span>
                                </span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-cyan-400">
                                {{ $exp->title }}
                            </h3>
                            @if($exp->organization)
                                <h4 class="text-xs sm:text-sm font-semibold text-slate-300 mb-2">
                                    {{ $exp->organization }}
                                </h4>
                            @endif
                            @if($exp->description)
                                <p class="text-xs text-slate-400 leading-relaxed">
                                    {{ $exp->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="relative">
                        <div class="absolute -left-[23px] sm:-left-[31px] top-4 w-4 h-4 rounded-full bg-cyan-400 border-4 border-[#070b19] shadow-[0_0_10px_#00f0ff]"></div>
                        <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800/80 hover:border-cyan-500/50 transition duration-300">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase bg-cyan-500/10 text-cyan-400 border border-cyan-500/30">
                                    PENDIDIKAN
                                </span>
                                <span class="text-xs font-semibold text-slate-400 flex items-center gap-1">
                                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>2024 – 2026</span>
                                </span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-cyan-400">
                                Web Developer
                            </h3>
                            <h4 class="text-xs sm:text-sm font-semibold text-slate-300 mb-2">
                                Organisasi
                            </h4>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                masih berlangsung sampai sekarang
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- === 6. CERTIFICATIONS SECTION (#sertifikat) === --}}
    <section id="sertifikat" class="relative py-16 sm:py-24 bg-[#090e23] border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-16">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Sertifikasi & Lisensi
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Pencapaian & Bukti Kompetensi
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Bukti keahlian dan kompetensi resmi yang diakui oleh lembaga pendidikan dan industri.
                </p>
            </div>

            {{-- Certificate Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-5xl mx-auto">
                @forelse ($certificates as $cert)
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800 hover:border-cyan-500/50 transition duration-300 flex flex-col sm:flex-row items-start gap-4 sm:gap-5">
                        @if($cert->image_url)
                            <div class="w-full sm:w-28 h-40 sm:h-24 rounded-xl overflow-hidden bg-slate-900 border border-slate-800 shrink-0 cursor-pointer group/img" onclick="openCertModal('{{ $cert->image_url }}', '{{ $cert->title }}')">
                                <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" class="w-full h-full object-cover group-hover/img:scale-105 transition duration-300">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2 0h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                        @endif
                        <div class="flex-1 w-full">
                            <span class="text-[10px] font-extrabold uppercase text-cyan-400 tracking-wider">{{ $cert->type }}</span>
                            <h3 class="text-base sm:text-lg font-bold text-white mt-1">{{ $cert->title }}</h3>
                            <p class="text-xs text-slate-400 mt-1 mb-3">{{ $cert->issuer }}</p>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="inline-block text-[11px] font-semibold text-slate-400 bg-slate-900 border border-slate-800 px-3 py-1 rounded-full">
                                    Tahun {{ $cert->year }}
                                </span>
                                @if($cert->image_url)
                                    <button type="button" onclick="openCertModal('{{ $cert->image_url }}', '{{ $cert->title }}')" class="text-xs font-bold text-cyan-400 hover:text-cyan-300 transition flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        <span>Lihat Sertifikat</span>
                                    </button>
                                @endif
                                @if($cert->link)
                                    <a href="{{ $cert->link }}" target="_blank" class="text-xs font-bold text-purple-400 hover:text-purple-300 transition flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                        <span>Kredensial</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="dark-glass-card p-5 sm:p-6 rounded-2xl border border-slate-800 hover:border-cyan-500/50 transition duration-300 flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2 0h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold uppercase text-cyan-400 tracking-wider">SERTIFIKASI KOMPETENSI</span>
                            <h3 class="text-base sm:text-lg font-bold text-white mt-1">Junior Web Developer</h3>
                            <p class="text-xs text-slate-400 mt-1 mb-3">SMK Negeri 1 Bangsri & Partners</p>
                            <span class="inline-block text-[11px] font-semibold text-slate-400 bg-slate-900 border border-slate-800 px-3 py-1 rounded-full">
                                Tahun 2024
                            </span>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Public Modal Preview Foto Sertifikat -->
            <div id="cert-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/85 backdrop-blur-md p-4" onclick="this.classList.add('hidden')">
                <div class="relative max-w-4xl w-full p-2" onclick="event.stopPropagation()">
                    <button type="button" onclick="document.getElementById('cert-modal').classList.add('hidden')" class="absolute -top-10 right-0 text-slate-300 hover:text-white text-2xl leading-none">&times; Tutup</button>
                    <img id="cert-modal-img" src="" alt="Sertifikat" class="w-full h-auto max-h-[85vh] object-contain rounded-2xl border border-slate-700 shadow-2xl">
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
    <section id="contact" class="relative py-16 sm:py-24 bg-[#070b19]">
        {{-- Subtle ambient grid background --}}
        <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:24px_24px] opacity-15 pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Header --}}
            <div class="text-center mb-12 sm:mb-16">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Hubungi Saya
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Mari Terhubung & Berkolaborasi
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                    Punya ide proyek, penawaran kerja sama, atau sekadar ingin berdiskusi? Pintu saya selalu terbuka!
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch max-w-6xl mx-auto">
                
                {{-- Left Column: Interactive Contact Command Center --}}
                <div class="lg:col-span-5 flex flex-col justify-between h-full p-6 sm:p-8 rounded-3xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-xl shadow-xl">
                    <div>
                        {{-- Availability status pill --}}
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span>Terbuka Untuk Peluang Baru</span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight mb-2">
                            Siap Memulai Proyek Anda?
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-6">
                            Saya selalu antusias berdiskusi seputar pembuatan website modern, sistem informasi, maupun kolaborasi pengembangan software.
                        </p>

                        {{-- Contact Items List --}}
                        <div class="space-y-3.5">
                            
                            {{-- Email item with Copy action --}}
                            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 hover:border-cyan-500/40 transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/25 flex items-center justify-center text-cyan-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-[11px] font-medium text-slate-400">Email Resmi</span>
                                        <a href="mailto:{{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}" class="text-xs sm:text-sm font-bold text-white hover:text-cyan-400 transition truncate block">
                                            {{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}
                                        </a>
                                    </div>
                                </div>
                                <button type="button" onclick="copyContactEmail('{{ $profile->email ?? 'adristyakikoyukinata@gmail.com' }}')" id="copy-email-btn" title="Salin Email" class="p-2 rounded-xl bg-slate-900 border border-slate-700/80 hover:border-cyan-500/50 text-slate-300 hover:text-cyan-400 transition shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </button>
                            </div>

                            {{-- WhatsApp item with direct chat action --}}
                            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 hover:border-emerald-500/40 transition-all flex items-center justify-between group">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-[11px] font-medium text-slate-400">Telepon / WhatsApp</span>
                                        <a href="{{ $profile->whatsapp_url ?? 'https://wa.me/6289639685566' }}" target="_blank" class="text-xs sm:text-sm font-bold text-white hover:text-emerald-400 transition truncate block">
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
                            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/25 flex items-center justify-center text-purple-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-[11px] font-medium text-slate-400">Domisili</span>
                                        <span class="text-xs sm:text-sm font-bold text-white">
                                            {{ $profile->location ?? 'Jepara, Jawa Tengah' }}
                                        </span>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-800 text-slate-400">
                                    WIB (UTC+7)
                                </span>
                            </div>

                        </div>
                    </div>

                    {{-- Social & Response note at bottom of card --}}
                    <div class="pt-6 mt-6 border-t border-slate-800/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-slate-400">
                        <span class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                            <span>Respons rata-rata: &lt; 24 jam</span>
                        </span>
                        <div class="flex items-center gap-2">
                            @if(!empty($profile->github_url))
                                <a href="{{ $profile->github_url }}" target="_blank" title="GitHub" class="p-2 rounded-lg bg-slate-950 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-600 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                </a>
                            @endif
                            @if(!empty($profile->linkedin_url))
                                <a href="{{ $profile->linkedin_url }}" target="_blank" title="LinkedIn" class="p-2 rounded-lg bg-slate-950 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-600 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                </a>
                            @endif
                            @if(!empty($profile->instagram_url))
                                <a href="{{ $profile->instagram_url }}" target="_blank" title="Instagram" class="p-2 rounded-lg bg-slate-950 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-600 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right Column: Modern High-Converting Contact Form --}}
                <div class="lg:col-span-7 flex flex-col h-full">
                    @if(session('contact_success'))
                        <div class="mb-4 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-bold flex items-center gap-2.5">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>{{ session('contact_success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="p-6 sm:p-8 rounded-3xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-xl shadow-xl flex-1 flex flex-col justify-between">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-white mb-1">
                                    Kirim Pesan
                                </h3>
                                <p class="text-xs text-slate-400">
                                    Isi formulir di bawah ini dan saya akan merespons ke email Anda sesegera mungkin.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nama Lengkap <span class="text-cyan-400">*</span></label>
                                    <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-950/70 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all" placeholder="Masukkan nama Anda">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Alamat Email <span class="text-cyan-400">*</span></label>
                                    <input type="email" name="email" required class="w-full px-4 py-3 bg-slate-950/70 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all" placeholder="nama@email.com">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Subjek / Topik</label>
                                <input type="text" name="subject" class="w-full px-4 py-3 bg-slate-950/70 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all" placeholder="e.g. Penawaran Proyek Website, Tanya Jawab, dll.">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Pesan Anda <span class="text-cyan-400">*</span></label>
                                <textarea name="message" rows="3" required class="w-full px-4 py-3 bg-slate-950/70 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all leading-relaxed resize-none" placeholder="Ceritakan kebutuhan proyek, timeline, atau detail pesan Anda di sini..."></textarea>
                            </div>
                        </div>

                        <div class="pt-6 mt-6 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 shadow-md shadow-cyan-500/25 transition-all duration-200 hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                                <span>Kirim Pesan Sekarang</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            <span class="text-[11px] text-slate-500 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
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
                btn.innerHTML = '<span class="text-xs font-bold text-cyan-400 px-1">Tersalin!</span>';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            }).catch(() => {
                prompt("Salin alamat email:", email);
            });
        }
    </script>

    {{-- === 8. FOOTER === --}}
    <footer class="py-8 bg-[#050814] border-t border-slate-800/80 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span>© 2026 {{ $profile->name ?? 'Adristy Akiko Yukinata' }}. All rights reserved.</span>
            <div class="flex items-center gap-6">
                <a href="#home" class="hover:text-cyan-400 transition flex items-center gap-1">
                    <span>Kembali ke Atas</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </a>
            </div>
        </div>
    </footer>

</x-landing-layout>