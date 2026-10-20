<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portofolio CMS - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Plus_Jakarta_Sans',sans-serif] antialiased bg-[#191919] text-[#F0EEE8] min-h-screen">
    
    <div class="min-h-screen flex flex-col md:flex-row bg-[#191919]">
        
        <!-- SIDEBAR -->
        <aside class="w-full md:w-72 bg-[#242424] border-r border-[#353535] flex flex-col justify-between shrink-0 min-h-screen p-6">
            <div class="space-y-8">
                
                <!-- Brand Header -->
                <div class="flex items-center gap-3.5 px-2">
                    <div class="w-11 h-11 rounded-2xl bg-[#758268] border border-[#8a997a]/30 flex items-center justify-center text-[#F0EEE8] shadow-md shadow-[#758268]/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-base font-extrabold text-[#F0EEE8] leading-tight">Portofolio CMS</h1>
                        <span class="text-xs font-bold text-[#A5B698]">Admin Panel</span>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Profil Saya -->
                    <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('admin.profile.*') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Profil Saya</span>
                    </a>

                    <!-- Kelola Proyek -->
                    <a href="{{ route('project.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('project.*') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Kelola Proyek</span>
                    </a>

                    <!-- Kelola Skill -->
                    <a href="{{ route('skill.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('skill.*') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        <span>Kelola Skill</span>
                    </a>

                    <!-- Pengalaman -->
                    <a href="{{ route('experience.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('experience.*') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Pengalaman</span>
                    </a>

                    <!-- Sertifikat -->
                    <a href="{{ route('certificate.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('certificate.*') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        <span>Sertifikat</span>
                    </a>

                    <!-- Pesan Masuk -->
                    <a href="{{ route('message.index') }}" class="flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-bold transition-all {{ request()->routeIs('message.*') ? 'bg-[#758268] text-[#F0EEE8] shadow-md shadow-[#758268]/20' : 'text-[#929292] hover:text-[#F0EEE8] hover:bg-[#191919]/60' }}">
                        <div class="flex items-center gap-3.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>Pesan Masuk</span>
                        </div>
                        @if(\App\Models\Message::where('is_read', false)->count() > 0)
                            <span class="px-2 py-0.5 text-[10px] font-black rounded-full bg-[#758268] text-[#F0EEE8] border border-[#8a997a]/40">
                                {{\App\Models\Message::where('is_read', false)->count()}}
                            </span>
                        @endif
                    </a>

                </nav>
            </div>

            <!-- Bottom Actions -->
            <div class="pt-6 border-t border-[#353535] space-y-3">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2.5 w-full py-3 px-4 rounded-2xl text-sm font-bold text-[#A5B698] bg-[#191919] border border-[#353535] hover:bg-[#2c2c2c] hover:border-[#A5B698]/50 hover:text-[#F0EEE8] transition shadow-inner">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span>Lihat Portofolio</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-2.5 w-full py-3 px-4 rounded-2xl text-sm font-bold text-rose-400 bg-rose-500/10 border border-rose-500/20 hover:bg-rose-500/20 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>

        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 min-w-0 p-4 sm:p-8 lg:p-10 overflow-y-auto">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-[#20251d] border border-[#444f3d] text-[#A5B698] text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{ $slot }}
        </main>

    </div>

</body>
</html>
