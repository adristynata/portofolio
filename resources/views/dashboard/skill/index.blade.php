<x-cms-layout>
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#F0EEE8]">Kelola Skill & Keahlian</h1>
            <p class="text-[#929292] text-sm mt-1">Kelola teknologi, bahasa pemrograman, dan persentase tingkat keahlian.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-skill').classList.remove('hidden')" class="px-5 py-2.5 rounded-xl font-bold text-sm text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20 flex items-center gap-2 active:scale-95">
            <span>+ Tambah Skill</span>
        </button>
    </div>

    <!-- Skills List Table -->
    <div class="bg-[#242424] rounded-2xl border border-[#353535] overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#191919] border-b border-[#353535] text-xs font-bold uppercase tracking-wider text-[#929292]">
                    <tr>
                        <th scope="col" class="px-6 py-4">Nama Skill</th>
                        <th scope="col" class="px-6 py-4">Kategori</th>
                        <th scope="col" class="px-6 py-4">Level</th>
                        <th scope="col" class="px-6 py-4">Persentase</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#353535]/60 text-[#F0EEE8]">
                    @forelse ($skills as $skill)
                        <tr class="hover:bg-[#191919]/40 transition">
                            <td class="px-6 py-4 font-bold text-[#F0EEE8] whitespace-nowrap flex items-center gap-2">
                                <span class="text-[#758268] font-extrabold">&lt;/&gt;</span>
                                <span>{{ $skill->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-[#929292]">
                                {{ $skill->category }}
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-[#758268]">
                                {{ $skill->level }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-24 bg-[#191919] border border-[#353535] h-2 rounded-full overflow-hidden">
                                        <div class="progress-gradient-bar h-full rounded-full" style="width: {{ $skill->percentage }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-[#F0EEE8]">{{ $skill->percentage }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button type="button" onclick="editSkill({{ json_encode($skill) }})" class="px-3 py-1.5 rounded-lg text-xs font-bold text-[#758268] bg-[#758268]/15 border border-[#758268]/30 hover:bg-[#758268]/25 transition mr-2">
                                    Edit
                                </button>
                                <form action="{{ route('skill.destroy', $skill->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus skill ini?')">
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
                            <td colspan="5" class="px-6 py-12 text-center text-[#929292] text-sm font-medium italic">
                                Belum ada data skill. Klik "+ Tambah Skill" untuk menambahkan keahlian baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Skill -->
    <div id="modal-add-skill" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#242424] border border-[#353535] rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-[#353535] mb-4">
                <h3 class="text-lg font-bold text-[#F0EEE8]">Tambah Skill Baru</h3>
                <button type="button" onclick="document.getElementById('modal-add-skill').classList.add('hidden')" class="text-[#929292] hover:text-[#F0EEE8] text-xl leading-none">&times;</button>
            </div>
            <form action="{{ route('skill.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Nama Skill / Teknologi</label>
                    <input type="text" name="name" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="e.g. Laravel, React, Tailwind CSS">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Kategori</label>
                        <select name="category" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                            <option value="Frontend Development">Frontend Development</option>
                            <option value="Backend Development">Backend Development</option>
                            <option value="Database">Database</option>
                            <option value="Design & UI/UX">Design & UI/UX</option>
                            <option value="Tools & Other">Tools & Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tingkat / Level</label>
                        <select name="level" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Persentase (Opsional)</label>
                    <input type="number" name="percentage" min="0" max="100" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Opsional (misal: 75)">
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-add-skill').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20">Simpan Skill</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Skill -->
    <div id="modal-edit-skill" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#242424] border border-[#353535] rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-[#353535] mb-4">
                <h3 class="text-lg font-bold text-[#F0EEE8]">Edit Skill</h3>
                <button type="button" onclick="document.getElementById('modal-edit-skill').classList.add('hidden')" class="text-[#929292] hover:text-[#F0EEE8] text-xl leading-none">&times;</button>
            </div>
            <form id="form-edit-skill" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Nama Skill / Teknologi</label>
                    <input type="text" id="edit-skill-name" name="name" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Kategori</label>
                        <select id="edit-skill-category" name="category" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                            <option value="Frontend Development">Frontend Development</option>
                            <option value="Backend Development">Backend Development</option>
                            <option value="Database">Database</option>
                            <option value="Design & UI/UX">Design & UI/UX</option>
                            <option value="Tools & Other">Tools & Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tingkat / Level</label>
                        <select id="edit-skill-level" name="level" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Persentase (Opsional)</label>
                    <input type="number" id="edit-skill-percentage" name="percentage" min="0" max="100" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Opsional (misal: 75)">
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit-skill').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20">Update Skill</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editSkill(skill) {
            const form = document.getElementById('form-edit-skill');
            form.action = '/dashboard/skill/' + skill.id;
            document.getElementById('edit-skill-name').value = skill.name;
            document.getElementById('edit-skill-category').value = skill.category;
            document.getElementById('edit-skill-level').value = skill.level;
            document.getElementById('edit-skill-percentage').value = skill.percentage;
            document.getElementById('modal-edit-skill').classList.remove('hidden');
        }
    </script>

</x-cms-layout>
