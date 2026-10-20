<nav class="fixed top-0 left-0 w-full z-50 backdrop-blur-xl bg-[#191919]/90 border-b border-[#353535] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Left: Logo & Brand Info -->
            <a href="#home" class="flex items-center gap-3.5 group">
                <div class="relative w-10 h-10 rounded-xl p-1 bg-[#242424] border border-[#353535] shadow-md flex items-center justify-center group-hover:scale-105 group-hover:border-[#758268]/50 transition-all duration-300">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo Adristy" class="w-full h-full object-contain dark:hidden drop-shadow-[0_2px_8px_rgba(56,189,248,0.35)]">
                    <img src="{{ asset('images/logo-dark.svg') }}" alt="Logo Adristy" class="w-full h-full object-contain hidden dark:block drop-shadow-[0_2px_8px_rgba(117,130,104,0.35)]">
                </div>
                <div class="flex flex-col">
                    <span class="text-[#F0EEE8] font-bold tracking-tight text-base group-hover:text-[#758268] transition-colors">
                        Adristy Akiko Yukinata
                    </span>
                    <span class="text-[10px] font-extrabold tracking-widest text-[#758268] uppercase">
                        BACKEND DEVELOPER
                    </span>
                </div>
            </a>

            <!-- Center: Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-7 text-sm font-medium">
                <a href="#about" class="nav-link text-[#929292] hover:text-[#F0EEE8] transition-colors relative py-1">Tentang Saya</a>
                <a href="#skill" class="nav-link text-[#929292] hover:text-[#F0EEE8] transition-colors relative py-1">Keahlian</a>
                <a href="#project" class="nav-link text-[#929292] hover:text-[#F0EEE8] transition-colors relative py-1">Proyek</a>
                <a href="#pengalaman" class="nav-link text-[#929292] hover:text-[#F0EEE8] transition-colors relative py-1">Pengalaman</a>
                <a href="#sertifikat" class="nav-link text-[#929292] hover:text-[#F0EEE8] transition-colors relative py-1">Sertifikat</a>
                <a href="#contact" class="nav-link text-[#929292] hover:text-[#F0EEE8] transition-colors relative py-1">Kontak</a>
            </div>

            <!-- Right: Actions (Theme Switcher & Authenticated Admin Link) -->
            <div class="hidden lg:flex items-center gap-3">
                <!-- Theme Switcher Button -->
                <button type="button" onclick="toggleTheme()" title="Beralih Mode Gelap / Terang" class="w-10 h-10 rounded-xl bg-[#242424] border border-[#353535] flex items-center justify-center text-amber-400 hover:bg-[#2c2c2c] transition-all shadow-inner">
                    <svg class="theme-icon-sun w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg class="theme-icon-moon w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                @auth
                    <!-- Admin Dashboard Link (Only visible when logged in) -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition-all bg-[#242424] border border-[#353535] text-[#F0EEE8] hover:border-[#758268]/50">
                            <svg class="w-4 h-4 text-[#758268]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-[#929292]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 rounded-xl shadow-2xl py-2 bg-[#242424] border border-[#353535] z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-[#F0EEE8] hover:bg-[#2c2c2c] hover:text-[#758268] transition">Dashboard CMS</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-[#F0EEE8] hover:bg-[#2c2c2c] hover:text-rose-400 transition">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Actions Button -->
            <div class="lg:hidden flex items-center gap-2">
                <button type="button" onclick="toggleTheme()" class="w-9 h-9 rounded-lg bg-[#242424] border border-[#353535] flex items-center justify-center text-amber-400">
                    <svg class="theme-icon-sun w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg class="theme-icon-moon w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                <button id="menu-btn" class="p-2 text-[#929292] hover:text-[#F0EEE8] rounded-lg bg-[#242424] border border-[#353535]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu Container -->
    <div id="menu" class="hidden lg:hidden px-6 pb-6 pt-2 bg-[#191919]/98 border-b border-[#353535] space-y-3">
        <a href="#about" class="block py-2 text-sm text-[#929292] hover:text-[#758268] transition">Tentang Saya</a>
        <a href="#skill" class="block py-2 text-sm text-[#929292] hover:text-[#758268] transition">Keahlian</a>
        <a href="#project" class="block py-2 text-sm text-[#929292] hover:text-[#758268] transition">Proyek</a>
        <a href="#pengalaman" class="block py-2 text-sm text-[#929292] hover:text-[#758268] transition">Pengalaman</a>
        <a href="#sertifikat" class="block py-2 text-sm text-[#929292] hover:text-[#758268] transition">Sertifikat</a>
        <a href="#contact" class="block py-2 text-sm text-[#929292] hover:text-[#758268] transition">Kontak</a>

        @auth
            <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-semibold text-[#758268]">Dashboard CMS</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left py-2 text-sm text-rose-400">Logout</button>
            </form>
        @endauth
    </div>
</nav>

<style>
.nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0%;
    height: 2px;
    background: #758268;
    transition: all 0.3s ease;
    border-radius: 2px;
}

html.light .nav-link::after {
    background: #0284c7;
}

.nav-link:hover::after {
    width: 100%;
}
</style>

.nav-link:hover::after {
    width: 100%;
}
</style>

<script>
function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.remove('light');
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
    updateThemeIcons();
}

function updateThemeIcons() {
    const isLight = document.documentElement.classList.contains('light');
    document.querySelectorAll('.theme-icon-sun').forEach(el => el.classList.toggle('hidden', isLight));
    document.querySelectorAll('.theme-icon-moon').forEach(el => el.classList.toggle('hidden', !isLight));
}

document.addEventListener('DOMContentLoaded', () => {
    updateThemeIcons();

    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
});
</script>
