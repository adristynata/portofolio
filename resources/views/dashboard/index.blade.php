<x-cms-layout>
    
    <!-- Greeting Header -->
    <div class="mb-10">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white flex items-center gap-3">
            <span>Selamat Datang, {{ Auth::user()->name ?? 'Adristy Akiko Yukinata' }}</span>
            <svg class="w-8 h-8 text-amber-400 inline-block animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5a1.5 1.5 0 013 0v3.5m0 0V11m0-5.5a1.5 1.5 0 013 0V11"></path></svg>
        </h1>
        <p class="text-slate-400 text-sm mt-2">
            Ringkasan status proyek portofolio dan pesan masuk Anda.
        </p>
    </div>

    <!-- 4 Stat Summary Cards matching Screenshot -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        
        <!-- Total Proyek -->
        <div class="bg-[#0b1026] p-6 rounded-2xl border border-slate-800/80 flex items-center justify-between shadow-xl">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-slate-400">TOTAL PROYEK</span>
                <div class="text-3xl font-black text-white mt-3">{{ $projectCount ?? 0 }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>

        <!-- Total Skill -->
        <div class="bg-[#0b1026] p-6 rounded-2xl border border-slate-800/80 flex items-center justify-between shadow-xl">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-slate-400">TOTAL SKILL</span>
                <div class="text-3xl font-black text-white mt-3">{{ $skillCount ?? 0 }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-indigo-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            </div>
        </div>

        <!-- Sertifikat -->
        <div class="bg-[#0b1026] p-6 rounded-2xl border border-slate-800/80 flex items-center justify-between shadow-xl">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-slate-400">SERTIFIKAT</span>
                <div class="text-3xl font-black text-white mt-3">{{ $certificateCount ?? 0 }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            </div>
        </div>

        <!-- Pesan Baru -->
        <div class="bg-[#0b1026] p-6 rounded-2xl border border-slate-800/80 flex items-center justify-between shadow-xl">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-slate-400">PESAN BARU</span>
                <div class="text-3xl font-black text-white mt-3">{{ $unreadMessageCount ?? 0 }}</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
        </div>

    </div>

    <!-- Pesan Masuk Terbaru Box matching Screenshot -->
    <div class="bg-[#0b1026] rounded-2xl border border-slate-800/80 p-6 sm:p-8 shadow-xl">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-800/80">
            <h2 class="text-lg font-bold text-white">
                Pesan Masuk Terbaru
            </h2>
            <a href="{{ route('message.index') }}" class="text-xs font-bold text-cyan-400 hover:text-cyan-300 transition">
                Lihat Semua Pesan
            </a>
        </div>

        <div class="space-y-4">
            @forelse ($latestMessages ?? [] as $msg)
                <div class="p-4 rounded-xl bg-[#090d21] border border-slate-800 flex items-start justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-bold text-white">{{ $msg->name }}</span>
                            <span class="text-xs text-slate-500">({{ $msg->email }})</span>
                            @if(!$msg->is_read)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Baru</span>
                            @endif
                        </div>
                        <h4 class="text-xs font-semibold text-cyan-400 mb-1">{{ $msg->subject ?? 'Tanpa Subjek' }}</h4>
                        <p class="text-xs text-slate-400 line-clamp-2">{{ $msg->message }}</p>
                    </div>
                    <span class="text-[11px] text-slate-500 whitespace-nowrap">{{ $msg->created_at->timezone('Asia/Jakarta')->diffForHumans() }}</span>
                </div>
            @empty
                <div class="py-12 text-center text-slate-500 text-sm font-medium italic">
                    Belum ada pesan masuk.
                </div>
            @endforelse
        </div>
    </div>

</x-cms-layout>
