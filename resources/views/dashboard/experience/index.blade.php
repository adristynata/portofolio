<x-cms-layout>
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#F0EEE8]">Kelola Pengalaman & Pendidikan</h1>
            <p class="text-[#929292] text-sm mt-1">Kelola riwayat pendidikan, posisi web developer, dan organisasi.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-experience').classList.remove('hidden')" class="px-5 py-2.5 rounded-xl font-bold text-sm text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20 flex items-center gap-2 active:scale-95">
            <span>+ Tambah Pengalaman</span>
        </button>
    </div>

    <!-- Experience List Table -->
    <div class="bg-[#242424] rounded-2xl border border-[#353535] overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#191919] border-b border-[#353535] text-xs font-bold uppercase tracking-wider text-[#929292]">
                    <tr>
                        <th scope="col" class="px-6 py-4">Tipe</th>
                        <th scope="col" class="px-6 py-4">Judul / Peran</th>
                        <th scope="col" class="px-6 py-4">Instansi / Organisasi</th>
                        <th scope="col" class="px-6 py-4">Periode</th>
                        <th scope="col" class="px-6 py-4">Deskripsi</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#353535]/60 text-[#F0EEE8]">
                    @forelse ($experiences as $item)
                        <tr class="hover:bg-[#191919]/40 transition">
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-[#20251d] text-[#A5B698] border border-[#444f3d]">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#F0EEE8] whitespace-nowrap">
                                {{ $item->title }}
                            </td>
                            <td class="px-6 py-4 text-xs text-[#F0EEE8]/90">
                                {{ $item->organization ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-[#A5B698] whitespace-nowrap flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>{{ $item->period }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-[#929292] max-w-xs truncate">
                                {{ $item->description }}
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button type="button" onclick="editExperience({{ json_encode($item) }})" class="px-3 py-1.5 rounded-lg text-xs font-bold text-[#A5B698] bg-[#20251d] border border-[#444f3d] hover:bg-[#283024] transition mr-2">
                                    Edit
                                </button>
                                <form action="{{ route('experience.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengalaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-400 bg-rose-500/10 border border-rose-500/30 hover:bg-rose-500/20 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-[#929292] text-sm font-medium italic">
                                Belum ada data pengalaman. Klik "+ Tambah Pengalaman" untuk menambah riwayat baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pengalaman -->
    <div id="modal-add-experience" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#242424] border border-[#353535] rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-[#353535] mb-4">
                <h3 class="text-lg font-bold text-[#F0EEE8]">Tambah Pengalaman Baru</h3>
                <button type="button" onclick="document.getElementById('modal-add-experience').classList.add('hidden')" class="text-[#929292] hover:text-[#F0EEE8] text-xl leading-none">&times;</button>
            </div>
            <form action="{{ route('experience.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tipe</label>
                        <select name="type" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                            <option value="PENDIDIKAN">PENDIDIKAN</option>
                            <option value="ORGANISASI">ORGANISASI</option>
                            <option value="PEKERJAAN">PEKERJAAN</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Periode (Tahun)</label>
                        <input type="text" name="period" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="2024 – 2026">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Judul / Peran</label>
                    <input type="text" name="title" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="e.g. Web Developer / Siswa RPL">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Instansi / Organisasi</label>
                    <input type="text" name="organization" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="e.g. SMK Negeri 1 Bangsri">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Deskripsi Ringkas</label>
                    <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Catatan aktivitas atau fokus..."></textarea>
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-add-experience').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20">Simpan Pengalaman</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Pengalaman -->
    <div id="modal-edit-experience" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#242424] border border-[#353535] rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-[#353535] mb-4">
                <h3 class="text-lg font-bold text-[#F0EEE8]">Edit Pengalaman</h3>
                <button type="button" onclick="document.getElementById('modal-edit-experience').classList.add('hidden')" class="text-[#929292] hover:text-[#F0EEE8] text-xl leading-none">&times;</button>
            </div>
            <form id="form-edit-experience" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tipe</label>
                        <select id="edit-exp-type" name="type" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                            <option value="PENDIDIKAN">PENDIDIKAN</option>
                            <option value="ORGANISASI">ORGANISASI</option>
                            <option value="PEKERJAAN">PEKERJAAN</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Periode (Tahun)</label>
                        <input type="text" id="edit-exp-period" name="period" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Judul / Peran</label>
                    <input type="text" id="edit-exp-title" name="title" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Instansi / Organisasi</label>
                    <input type="text" id="edit-exp-organization" name="organization" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Deskripsi Ringkas</label>
                    <textarea id="edit-exp-description" name="description" rows="3" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]"></textarea>
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit-experience').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20">Update Pengalaman</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editExperience(item) {
            const form = document.getElementById('form-edit-experience');
            form.action = '/dashboard/experience/' + item.id;
            document.getElementById('edit-exp-type').value = item.type;
            document.getElementById('edit-exp-period').value = item.period;
            document.getElementById('edit-exp-title').value = item.title;
            document.getElementById('edit-exp-organization').value = item.organization || '';
            document.getElementById('edit-exp-description').value = item.description || '';
            document.getElementById('modal-edit-experience').classList.remove('hidden');
        }
    </script>

</x-cms-layout>
