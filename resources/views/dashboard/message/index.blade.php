<x-cms-layout>
    
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Kotak Pesan Masuk (Inbox)</h1>
        <p class="text-slate-400 text-sm mt-1">Daftar pesan dan penawaran kerja sama yang dikirimkan melalui form kontak portofolio.</p>
    </div>

    <!-- Messages List -->
    <div class="space-y-4">
        @forelse ($messages as $item)
            <div class="bg-[#0b1026] p-6 rounded-2xl border {{ $item->is_read ? 'border-slate-800/80' : 'border-cyan-500/40 bg-cyan-950/10' }} shadow-xl transition">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800/80 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <span>{{ $item->name }}</span>
                                @if(!$item->is_read)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase bg-emerald-500 text-white">Baru</span>
                                @endif
                            </h3>
                            <a href="mailto:{{ $item->email }}" class="text-xs text-slate-400 hover:text-cyan-400 transition">{{ $item->email }}</a>
                        </div>
                    </div>
                    <span class="text-xs font-medium text-slate-500">
                        {{ $item->created_at->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB ({{ $item->created_at->timezone('Asia/Jakarta')->diffForHumans() }})
                    </span>
                </div>

                @if($item->subject)
                    <div class="text-xs font-bold text-cyan-400 mb-2">Subjek: {{ $item->subject }}</div>
                @endif

                <p class="text-sm text-slate-300 leading-relaxed mb-6 whitespace-pre-line bg-[#090d21] p-4 rounded-xl border border-slate-800">
                    {{ $item->message }}
                </p>

                <div class="flex items-center justify-between pt-2 border-t border-slate-800/60">
                    <form action="{{ route('message.read', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ $item->is_read ? 'text-slate-400 bg-slate-900 border border-slate-800 hover:text-white' : 'text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 hover:bg-emerald-500/20' }}">
                            {{ $item->is_read ? 'Tandai Belum Dibaca' : '✓ Tandai Sudah Dibaca' }}
                        </button>
                    </form>

                    <form action="{{ route('message.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan me-masuk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3.5 py-1.5 rounded-lg text-xs font-bold text-rose-400 bg-rose-500/10 border border-rose-500/30 hover:bg-rose-500/20 transition">
                            Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-[#0b1026] p-12 rounded-2xl border border-slate-800/80 text-center text-slate-500 text-sm font-medium italic">
                Belum ada pesan masuk di kotak masuk Anda.
            </div>
        @endforelse
    </div>

</x-cms-layout>
