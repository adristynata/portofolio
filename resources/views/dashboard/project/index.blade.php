<x-cms-layout>
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#F0EEE8]">Kelola Proyek</h1>
            <p class="text-[#929292] text-sm mt-1">Tambah, edit, dan hapus karya portofolio Anda.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-project').classList.remove('hidden')" class="px-5 py-2.5 rounded-xl font-bold text-sm text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20 flex items-center gap-2 active:scale-95">
            <span>+ Tambah Proyek</span>
        </button>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm font-semibold space-y-1">
            <div class="font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>Gagal Menyimpan Proyek:</span>
            </div>
            <ul class="list-disc list-inside text-xs pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Project List Table -->
    <div class="bg-[#242424] rounded-2xl border border-[#353535] overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#191919] border-b border-[#353535] text-xs font-bold uppercase tracking-wider text-[#929292]">
                    <tr>
                        <th scope="col" class="px-5 py-4 w-20">Gambar</th>
                        <th scope="col" class="px-5 py-4 min-w-[180px]">Judul Proyek</th>
                        <th scope="col" class="px-5 py-4">Deskripsi</th>
                        <th scope="col" class="px-5 py-4 w-28">Tautan</th>
                        <th scope="col" class="px-5 py-4 text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#353535]/60 text-[#F0EEE8]">
                    @forelse ($projects as $item)
                        <tr class="hover:bg-[#191919]/40 transition">
                            <td class="px-5 py-4">
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-16 h-12 object-cover rounded-xl border border-[#353535]">
                                @else
                                    <div class="w-16 h-12 rounded-xl bg-[#191919] border border-[#353535] flex items-center justify-center text-[#929292] font-bold text-xs">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4 font-bold text-[#F0EEE8]">
                                {{ $item->title }}
                            </td>
                            <td class="px-5 py-4 text-xs text-[#929292] max-w-xs truncate">
                                {{ $item->description }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    @if($item->github_link)
                                        <a href="{{ $item->github_link }}" target="_blank" title="GitHub: {{ $item->github_link }}" class="p-2 rounded-lg bg-[#191919] border border-[#353535] text-[#758268] hover:bg-[#758268]/15 hover:border-[#758268]/50 transition">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                        </a>
                                    @endif
                                    @if($item->demo_link)
                                        <a href="{{ $item->demo_link }}" target="_blank" title="Web Link: {{ $item->demo_link }}" class="p-2 rounded-lg bg-[#191919] border border-[#353535] text-[#758268] hover:bg-[#758268]/15 hover:border-[#758268]/50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif
                                    @if(!$item->github_link && !$item->demo_link)
                                        <span class="text-xs text-[#929292]">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="editProject({{ json_encode($item) }})" class="px-3.5 py-1.5 rounded-xl text-xs font-bold text-[#758268] bg-[#758268]/15 border border-[#758268]/30 hover:bg-[#758268]/25 transition flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        <span>Edit</span>
                                    </button>
                                    <form action="{{ route('project.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3.5 py-1.5 rounded-xl text-xs font-bold text-rose-400 bg-rose-500/10 border border-rose-500/30 hover:bg-rose-500/20 transition flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#929292] text-sm font-medium italic">
                                Belum ada proyek. Klik "+ Tambah Proyek" untuk membuat proyek baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Proyek -->
    <div id="modal-add-project" class="{{ $errors->any() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#242424] border border-[#353535] rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-[#353535] mb-4">
                <h3 class="text-lg font-bold text-[#F0EEE8]">Tambah Proyek Baru</h3>
                <button type="button" onclick="document.getElementById('modal-add-project').classList.add('hidden')" class="text-[#929292] hover:text-[#F0EEE8] text-xl leading-none">&times;</button>
            </div>
            <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Judul Proyek</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="e.g. E-Commerce Tote Bag">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Deskripsi Proyek</label>
                    <textarea name="description" rows="4" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Deskripsi mengenai proyek Anda...">{{ old('description') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tautan GitHub (Opsional)</label>
                        <input type="url" name="github_link" value="{{ old('github_link') }}" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://github.com/...">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tautan Web / URL (Opsional)</label>
                        <input type="url" name="demo_link" value="{{ old('demo_link') }}" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://website-anda.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Gambar Preview Proyek (PNG, JPG, WEBP, maks 5MB)</label>
                    <input type="file" name="image" required accept="image/*" class="w-full px-3 py-2 bg-[#191919] border border-[#353535] rounded-xl text-xs text-[#929292] focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#758268] file:text-[#F0EEE8] hover:file:bg-[#859376]">
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-add-project').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20">Simpan Proyek</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Proyek -->
    <div id="modal-edit-project" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/75 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#242424] border border-[#353535] rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-[#353535] mb-4">
                <h3 class="text-lg font-bold text-[#F0EEE8]">Edit Proyek</h3>
                <button type="button" onclick="document.getElementById('modal-edit-project').classList.add('hidden')" class="text-[#929292] hover:text-[#F0EEE8] text-xl leading-none">&times;</button>
            </div>
            <form id="form-edit-project" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Judul Proyek</label>
                    <input type="text" id="edit-title" name="title" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Deskripsi Proyek</label>
                    <textarea id="edit-description" name="description" rows="4" required class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tautan GitHub (Opsional)</label>
                        <input type="url" id="edit-github_link" name="github_link" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Tautan Web / URL (Opsional)</label>
                        <input type="url" id="edit-demo_link" name="demo_link" class="w-full px-3.5 py-2.5 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://website-anda.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-1">Ubah Gambar Preview (Opsional, maks 5MB)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 bg-[#191919] border border-[#353535] rounded-xl text-xs text-[#929292] focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#758268] file:text-[#F0EEE8] hover:file:bg-[#859376]">
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit-project').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-[#929292] bg-[#191919] border border-[#353535] hover:text-[#F0EEE8]">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20">Update Proyek</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editProject(project) {
            const form = document.getElementById('form-edit-project');
            form.action = '/dashboard/project/' + project.id;
            document.getElementById('edit-title').value = project.title;
            document.getElementById('edit-description').value = project.description;
            document.getElementById('edit-github_link').value = project.github_link || '';
            document.getElementById('edit-demo_link').value = project.demo_link || '';
            document.getElementById('modal-edit-project').classList.remove('hidden');
        }
    </script>

</x-cms-layout>
