<x-cms-layout>
    
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Profil Saya & Link Media Sosial</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola data pribadi, teks Hero, biografi About Me, dan tautan media sosial yang akan tampil di halaman depan portofolio.</p>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-[#0b1026] p-6 sm:p-8 rounded-2xl border border-slate-800/80 shadow-xl space-y-8">
            @csrf

            <!-- Section 1: Informasi Utama -->
            <div>
                <h3 class="text-base font-bold text-cyan-400 pb-2 border-b border-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Informasi Utama & Foto</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Email Admin</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Judul Peran (Role Title)</label>
                        <input type="text" name="role_title" value="{{ old('role_title', $user->role_title) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="Web Developer / Backend Engineer">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Foto Profil</label>
                        <input type="file" name="photo" class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-slate-300 focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-cyan-500 file:text-white hover:file:bg-cyan-400">
                    </div>
                </div>

                <!-- Teks Hero Section vs Teks About Section -->
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div>
                        <label class="block text-xs font-bold text-cyan-400 mb-1 flex items-center gap-1.5">
                            <span>✨ Teks Ringkas Hero Section (Paling Atas Halaman)</span>
                        </label>
                        <p class="text-[11px] text-slate-400 mb-2">Teks pengenalan singkat yang tampil langsung di bawah nama Anda pada bagian Hero paling atas.</p>
                        <textarea name="hero_bio" rows="2" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="e.g. Saya adalah Junior Web Developer & Software Engineer dari SMK Negeri 1 Bangsri yang berfokus pada...">{{ old('hero_bio', $user->hero_bio ?? 'Saya adalah Junior Web Developer & Software Engineer dari SMK Negeri 1 Bangsri yang berfokus pada pengembangan aplikasi web modern, responsif, dan berperforma tinggi.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-purple-400 mb-1 flex items-center gap-1.5">
                            <span>📖 Teks Biografi About Section (Bagian "Tentang Saya")</span>
                        </label>
                        <p class="text-[11px] text-slate-400 mb-2">Biografi narasi lengkap tentang diri Anda yang tampil pada bagian "Tentang Saya".</p>
                        <textarea name="bio" rows="4" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="Tuliskan cerita biografi lengkap Anda di sini...">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Detail Profil (4 Cards Component) -->
            <div>
                <h3 class="text-base font-bold text-cyan-400 pb-2 border-b border-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    <span>Detail Informasi Tambahan</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Pendidikan</label>
                        <input type="text" name="education" value="{{ old('education', $user->education) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="Teknik Informatika / RPL">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Fokus Utama</label>
                        <input type="text" name="focus" value="{{ old('focus', $user->focus) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="Web & Backend Dev">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">No. Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="+62 89639685566">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $user->location) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="Jepara">
                    </div>
                </div>
            </div>

            <!-- Section 3: Link Media Sosial (Requirement User) -->
            <div>
                <h3 class="text-base font-bold text-cyan-400 pb-2 border-b border-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    <span>Link Media Sosial</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">URL GitHub</label>
                        <input type="url" name="github_url" value="{{ old('github_url', $user->github_url) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="https://github.com/username">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">URL LinkedIn</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">URL Instagram</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="https://instagram.com/username">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Link WhatsApp Direct</label>
                        <input type="url" name="whatsapp_url" value="{{ old('whatsapp_url', $user->whatsapp_url) }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-cyan-500" placeholder="https://wa.me/6289639685566">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 transition shadow-lg shadow-blue-600/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    <span>Simpan Perubahan Profil & Sosmed</span>
                </button>
            </div>

        </form>
    </div>

</x-cms-layout>
