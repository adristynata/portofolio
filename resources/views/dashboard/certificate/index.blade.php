<x-cms-layout>
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Kelola Sertifikat & Lisensi</h1>
            <p class="text-slate-400 text-sm mt-1">Tambah, edit, dan upload foto/gambar bukti sertifikat kompetensi Anda.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-certificate').classList.remove('hidden')" class="px-5 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 transition shadow-lg shadow-blue-500/25 flex items-center gap-2">
            <span>+ Tambah Sertifikat</span>
        </button>
    </div>

    <!-- Certificate List Table -->
    <div class="bg-[#0b1026] rounded-2xl border border-slate-800/80 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#090d21] border-b border-slate-800 text-xs font-bold uppercase tracking-wider text-slate-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">Foto Sertifikat</th>
                        <th scope="col" class="px-6 py-4">Tipe</th>
                        <th scope="col" class="px-6 py-4">Nama Sertifikat</th>
                        <th scope="col" class="px-6 py-4">Penerbit (Issuer)</th>
                        <th scope="col" class="px-6 py-4">Tahun</th>
                        <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse ($certificates as $item)
                        <tr class="hover:bg-slate-900/40 transition">
                            <td class="px-6 py-4">
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-16 h-12 object-cover rounded-xl border border-slate-800 cursor-pointer hover:scale-105 transition" onclick="showImageModal('{{ $item->image_url }}', '{{ $item->title }}')">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-purple-500/10 text-purple-400 border border-purple-500/30">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-white whitespace-nowrap">
                                {{ $item->title }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-300">
                                {{ $item->issuer }}
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-cyan-400 whitespace-nowrap">
                                {{ $item->year }}
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button type="button" onclick="editCertificate({{ json_encode($item) }})" class="px-3 py-1.5 rounded-lg text-xs font-bold text-cyan-400 bg-cyan-500/10 border border-cyan-500/30 hover:bg-cyan-500/20 transition mr-2">
                                    Edit
                                </button>
                                <form action="{{ route('certificate.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">
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
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 text-sm font-medium italic">
                                Belum ada data sertifikat. Klik "+ Tambah Sertifikat" untuk menambahkan bukti kompetensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Preview Foto Sertifikat -->
    <div id="modal-preview-image" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md p-4 overflow-y-auto" onclick="this.classList.add('hidden')">
        <div class="relative max-w-3xl w-full p-2" onclick="event.stopPropagation()">
            <img id="preview-image-src" src="" alt="Sertifikat" class="w-full h-auto max-h-[85vh] object-contain rounded-2xl border border-slate-700 shadow-2xl">
            <p id="preview-image-title" class="text-center text-sm font-bold text-white mt-3"></p>
        </div>
    </div>

    <!-- Modal Tambah Sertifikat -->
    <div id="modal-add-certificate" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#0b1026] border border-slate-800 rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-800 mb-4">
                <h3 class="text-lg font-bold text-white">Tambah Sertifikat Baru</h3>
                <button type="button" onclick="document.getElementById('modal-add-certificate').classList.add('hidden')" class="text-slate-400 hover:text-white text-xl leading-none">&times;</button>
            </div>
            <form action="{{ route('certificate.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Tipe Sertifikasi</label>
                        <input type="text" name="type" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="e.g. SERTIFIKASI KOMPETENSI">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Tahun Perolehan</label>
                        <input type="text" name="year" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="2024">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Nama Sertifikat</label>
                    <input type="text" name="title" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="e.g. Junior Web Developer">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Penerbit (Issuer)</label>
                    <input type="text" name="issuer" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="e.g. SMK Negeri 1 Bangsri & Partners">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Upload Foto / Gambar Sertifikat (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3.5 py-2 bg-slate-950 border border-slate-800 rounded-xl text-xs text-slate-300 focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-500 file:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Link Kredensial / Verifikasi (Opsional)</label>
                    <input type="url" name="link" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="https://credential.example.com/...">
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-add-certificate').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-400 bg-slate-900 border border-slate-800 hover:text-white">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400">Simpan Sertifikat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Sertifikat -->
    <div id="modal-edit-certificate" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4 overflow-y-auto">
        <div class="bg-[#0b1026] border border-slate-800 rounded-2xl w-full max-w-lg p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-slate-800 mb-4">
                <h3 class="text-lg font-bold text-white">Edit Sertifikat</h3>
                <button type="button" onclick="document.getElementById('modal-edit-certificate').classList.add('hidden')" class="text-slate-400 hover:text-white text-xl leading-none">&times;</button>
            </div>
            <form id="form-edit-certificate" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Tipe Sertifikasi</label>
                        <input type="text" id="edit-cert-type" name="type" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Tahun Perolehan</label>
                        <input type="text" id="edit-cert-year" name="year" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Nama Sertifikat</label>
                    <input type="text" id="edit-cert-title" name="title" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Penerbit (Issuer)</label>
                    <input type="text" id="edit-cert-issuer" name="issuer" required class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Ubah Foto / Gambar Sertifikat (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3.5 py-2 bg-slate-950 border border-slate-800 rounded-xl text-xs text-slate-300 focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-500 file:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Link Kredensial / Verifikasi (Opsional)</label>
                    <input type="url" id="edit-cert-link" name="link" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-edit-certificate').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-400 bg-slate-900 border border-slate-800 hover:text-white">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400">Update Sertifikat</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showImageModal(src, title) {
            document.getElementById('preview-image-src').src = src;
            document.getElementById('preview-image-title').innerText = title;
            document.getElementById('modal-preview-image').classList.remove('hidden');
        }

        function editCertificate(item) {
            const form = document.getElementById('form-edit-certificate');
            form.action = '/dashboard/certificate/' + item.id;
            document.getElementById('edit-cert-type').value = item.type;
            document.getElementById('edit-cert-year').value = item.year;
            document.getElementById('edit-cert-title').value = item.title;
            document.getElementById('edit-cert-issuer').value = item.issuer;
            document.getElementById('edit-cert-link').value = item.link || '';
            document.getElementById('modal-edit-certificate').classList.remove('hidden');
        }
    </script>

</x-cms-layout>
