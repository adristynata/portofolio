<x-cms-layout>
    
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#F0EEE8]">Kotak Pesan Masuk (Inbox)</h1>
        <p class="text-[#929292] text-sm mt-1">Daftar pesan dan penawaran kerja sama yang dikirimkan melalui form kontak portofolio.</p>
    </div>

    <!-- Messages List -->
    <div class="space-y-4">
        @forelse ($messages as $item)
            <div class="bg-[#242424] p-6 rounded-2xl border {{ $item->is_read ? 'border-[#353535]' : 'border-[#758268]/50 bg-[#758268]/5' }} shadow-xl transition">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#353535] mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#191919] border border-[#353535] flex items-center justify-center text-[#758268]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-[#F0EEE8] flex items-center gap-2">
                                <span>{{ $item->name }}</span>
                                @if(!$item->is_read)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase bg-[#758268] text-[#F0EEE8]">Baru</span>
                                @endif
                            </h3>
                            <a href="mailto:{{ $item->email }}" class="text-xs text-[#929292] hover:text-[#758268] transition">{{ $item->email }}</a>
                        </div>
                    </div>
                    <span class="text-xs font-medium text-[#929292]">
                        {{ $item->created_at->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB ({{ $item->created_at->timezone('Asia/Jakarta')->diffForHumans() }})
                    </span>
                </div>

                @if($item->subject)
                    <div class="text-xs font-bold text-[#758268] mb-2">Subjek: {{ $item->subject }}</div>
                @endif

                <p class="text-sm text-[#F0EEE8]/90 leading-relaxed mb-6 whitespace-pre-line bg-[#191919] p-4 rounded-xl border border-[#353535]">
                    {{ $item->message }}
                </p>

                <div class="flex items-center justify-between pt-2 border-t border-[#353535]/80">
                    <form action="{{ route('message.read', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ $item->is_read ? 'text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]' : 'text-[#758268] bg-[#758268]/15 border border-[#758268]/30 hover:bg-[#758268]/25' }}">
                            {{ $item->is_read ? 'Tandai Belum Dibaca' : '✓ Tandai Sudah Dibaca' }}
                        </button>
                    </form>

                    <form action="{{ route('message.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan masuk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3.5 py-1.5 rounded-lg text-xs font-bold text-rose-400 bg-rose-500/10 border border-rose-500/30 hover:bg-rose-500/20 transition">
                            Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-[#242424] p-12 rounded-2xl border border-[#353535] text-center text-[#929292] text-sm font-medium italic">
                Belum ada pesan masuk di kotak masuk Anda.
            </div>
        @endforelse
    </div>

</x-cms-layout>
