{{--
    Site navigation — minimal editorial header.
    Desktop: brand · section links · theme toggle · CTA pill.
    Mobile : brand · theme toggle · round burger → full-screen numbered menu.
    Scroll behaviour (transparent at top, frosted when scrolled, hide on scroll-down)
    and the active-link scrollspy are handled in resources/js/smooth-scroll.js.
--}}
@php
    $navItems = [
        ['href' => '#home',        'label' => 'OVERVIEW'],
        ['href' => '#about',       'label' => 'ME'],
        ['href' => '#skill',       'label' => 'TECH'],
        ['href' => '#project',     'label' => 'SHOWCASE'],
        ['href' => '#pengalaman',  'label' => 'EXP'],
        ['href' => '#sertifikat',  'label' => 'CERTS'],
        ['href' => '#contact',     'label' => 'CONTACT'],
    ];

    $mobileNavItems = [
        ['href' => '#home',        'label' => 'Overview',         'tag' => 'OVERVIEW'],
        ['href' => '#about',       'label' => 'Tentang Saya',     'tag' => 'ME'],
        ['href' => '#skill',       'label' => 'Keahlian & Tech',  'tag' => 'TECH'],
        ['href' => '#project',     'label' => 'Proyek Unggulan',  'tag' => 'SHOWCASE'],
        ['href' => '#pengalaman',  'label' => 'Pengalaman Kerja', 'tag' => 'EXP'],
        ['href' => '#sertifikat',  'label' => 'Sertifikasi',      'tag' => 'CERTS'],
        ['href' => '#contact',     'label' => 'Hubungi Saya',     'tag' => 'CONTACT'],
    ];

    $brandFirstName = \Illuminate\Support\Str::of($profile->name ?? 'Adristy Akiko Yukinata')->explode(' ')->first();
    $contactEmail   = $profile->email ?? 'adristyakikoyukinata@gmail.com';
@endphp

<header id="siteNav" class="site-nav">
    <div class="site-nav__inner">

        {{-- Brand Pill (Left) --}}
        <a href="#home" class="site-nav__brand-badge" aria-label="{{ $brandFirstName }} — kembali ke atas">
            <x-brand-mark class="site-nav__mark" />
            <span class="site-nav__name">{{ $brandFirstName }}<em>.dev</em></span>
        </a>

        {{-- Floating Capsule Navbar (Center — matching user's design reference) --}}
        <nav class="site-nav__capsule" aria-label="Navigasi utama">
            @foreach ($navItems as $item)
                <a href="{{ $item['href'] }}" class="nav-link site-nav__link">
                    <span>{{ $item['label'] }}</span>
                    <span class="site-nav__indicator" aria-hidden="true"></span>
                </a>
            @endforeach
        </nav>

        {{-- Actions Pill (Right) --}}
        <div class="site-nav__actions">
            @auth
                <div class="site-nav__account" x-data="{ open: false }" @keydown.escape.window="open = false">
                    <button type="button" @click="open = !open" class="site-nav__icon-btn" :aria-expanded="open.toString()" aria-haspopup="true" aria-label="Menu admin" title="{{ Auth::user()->name }}">
                        <span class="site-nav__avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(Auth::user()->name, 0, 1)) }}</span>
                    </button>
                    <div x-show="open" x-cloak @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="site-nav__dropdown" role="menu">
                        <span class="site-nav__dropdown-label">{{ Auth::user()->name }}</span>
                        <a href="{{ route('dashboard') }}" class="site-nav__dropdown-item" role="menuitem">Dashboard CMS</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="site-nav__dropdown-item site-nav__dropdown-item--danger" role="menuitem">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth

            <a href="#contact" class="nav-link site-nav__cta-badge">
                <span class="site-nav__cta-dot" aria-hidden="true"></span>
                <span class="hidden sm:inline">Hubungi</span>
                <span class="sm:hidden">Kontak</span>
            </a>

            <button type="button" id="navBurger" class="site-nav__burger" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu">
                <span></span><span></span>
            </button>
        </div>
    </div>
</header>

{{-- Mobile full-screen menu --}}
<div id="mobileMenu" class="mnav" aria-hidden="true">
    <p class="mnav__label">(Menu Navigasi)</p>
    <nav class="mnav__links" aria-label="Navigasi mobile">
        @foreach ($mobileNavItems as $i => $item)
            <a href="{{ $item['href'] }}" style="--i: {{ $i }}">
                <i>{{ sprintf('%02d', $i + 1) }}</i>
                <span>{{ $item['label'] }}</span>
                <small class="mnav__tag">/ {{ $item['tag'] }}</small>
            </a>
        @endforeach
    </nav>

    @auth
        <div class="mnav__admin">
            <a href="{{ route('dashboard') }}">Dashboard CMS</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    @endauth

    <div class="mnav__foot">
        <span>{{ $profile->role_title ?? 'Backend Developer' }} · {{ $profile->location ?? 'Jepara, Indonesia' }}</span>
        <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
    </div>
</div>

<script>
    (function () {
        const burger = document.getElementById('navBurger');
        const menu = document.getElementById('mobileMenu');
        const nav = document.getElementById('siteNav');

        function setMenu(open) {
            if (!burger || !menu) return;
            burger.classList.toggle('is-open', open);
            menu.classList.toggle('is-open', open);
            nav && nav.classList.toggle('menu-open', open);
            burger.setAttribute('aria-expanded', String(open));
            burger.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
            menu.setAttribute('aria-hidden', String(!open));
            document.documentElement.style.overflow = open ? 'hidden' : '';
            if (window.__lenis) open ? window.__lenis.stop() : window.__lenis.start();
        }

        // Exposed so the smooth-scroll anchor handler can close the menu after navigation.
        window.closeMobileNav = () => setMenu(false);

        if (burger && menu) {
            burger.addEventListener('click', () => setMenu(!menu.classList.contains('is-open')));
            menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => setMenu(false)));
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });
            window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => { if (e.matches) setMenu(false); });
        }
    })();
</script>
