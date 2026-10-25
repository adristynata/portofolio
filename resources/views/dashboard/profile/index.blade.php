<x-cms-layout>
    
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#F0EEE8]">Profil Saya & Link Media Sosial</h1>
            <p class="text-[#929292] text-sm mt-1">Kelola data pribadi, teks Hero, biografi About Me, dan tautan media sosial yang akan tampil di halaman depan portofolio.</p>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-[#242424] p-6 sm:p-8 rounded-2xl border border-[#353535] shadow-xl space-y-8">
            @csrf

            <!-- Section 1: Informasi Utama -->
            <div>
                <h3 class="text-base font-bold text-[#A5B698] pb-2 border-b border-[#353535] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Informasi Utama & Foto</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Email Admin</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Judul Peran (Role Title)</label>
                        <input type="text" name="role_title" value="{{ old('role_title', $user->role_title) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Web Developer / Backend Engineer">
                    </div>
                    <div x-data="{
                        photoPreview: null,
                        updatePreview(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => { this.photoPreview = e.target.result; };
                                reader.readAsDataURL(file);
                            }
                        }
                    }">
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Foto Profil (Section Tentang / About)</span>
                        </label>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-[#191919] border border-[#353535] overflow-hidden flex items-center justify-center shrink-0 shadow-md">
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover" alt="Preview Foto Baru">
                                </template>
                                <template x-if="!photoPreview">
                                    @php
                                        $cmsPhotoSrc = asset('images/adristy_studio.png');
                                        if (!empty($user->photo)) {
                                            if (str_starts_with($user->photo, 'http') || str_starts_with($user->photo, 'data:')) {
                                                $cmsPhotoSrc = $user->photo;
                                            } elseif (str_starts_with($user->photo, 'storage/')) {
                                                $cmsPhotoSrc = asset($user->photo);
                                            } else {
                                                $cmsPhotoSrc = asset('storage/' . $user->photo);
                                            }
                                        }
                                    @endphp
                                    <img src="{{ $cmsPhotoSrc }}" class="w-full h-full object-cover" alt="Foto Profil">
                                </template>
                            </div>
                            <input type="file" name="photo" accept="image/*" @change="updatePreview($event)" class="w-full px-4 py-2 bg-[#191919] border border-[#353535] rounded-xl text-xs text-[#929292] focus:outline-none file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#758268] file:text-[#F0EEE8] hover:file:bg-[#859376]">
                        </div>
                        <p class="text-[10px] text-[#929292] mt-1.5">Foto potret ini otomatis tampil pada bingkai polaroid artistik di bagian <strong>Tentang Saya</strong> (tampil versi berwarna & hitam-putih). Format JPG/PNG/WEBP.</p>
                    </div>
                </div>

                <!-- Konten Teks About Section (Headline & Biografi) -->
                <div class="grid grid-cols-1 gap-6 mt-6 pt-6 border-t border-[#353535]">
                    <div>
                        <label class="block text-xs font-bold text-[#A5B698] mb-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            <span>Headline / Judul Utama (About Section)</span>
                        </label>
                        <p class="text-[11px] text-[#929292] mb-2">Judul tebal yang tampil di bagian "Tentang Saya". Anda bisa menekan Enter untuk baris baru. (Default: <em>Membangun Solusi Web yang Terstruktur & Handal.</em>)</p>
                        <textarea name="hero_bio" rows="2" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Membangun Solusi Web yang Terstruktur & Handal.">{{ old('hero_bio', $user->hero_bio) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#A5B698] mb-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            <span>Biografi Singkat (About Section)</span>
                        </label>
                        <p class="text-[11px] text-[#929292] mb-2">Teks biografi diri Anda di bagian "Tentang Saya". Buat secara ringkas dan to-the-point sesuai keinginan Anda tanpa kepanjangan.</p>
                        <textarea name="bio" rows="3" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Saya Adristy Akiko Yukinata, siswi Rekayasa Perangkat Lunak dari SMK Negeri 1 Bangsri. Berfokus pada pengembangan web modern dan arsitektur backend...">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Detail Profil (4 Cards Component) -->
            <div>
                <h3 class="text-base font-bold text-[#A5B698] pb-2 border-b border-[#353535] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    <span>Detail Informasi Tambahan</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Pendidikan</label>
                        <input type="text" name="education" value="{{ old('education', $user->education) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Teknik Informatika / RPL">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Fokus Utama</label>
                        <input type="text" name="focus" value="{{ old('focus', $user->focus) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Web & Backend Dev">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">No. Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="+62 89639685566">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $user->location) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Jepara">
                    </div>
                </div>
            </div>

            <!-- Section 3: Link Media Sosial -->
            <div>
                <h3 class="text-base font-bold text-[#A5B698] pb-2 border-b border-[#353535] mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    <span>Link Media Sosial</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">URL GitHub</label>
                        <input type="url" name="github_url" value="{{ old('github_url', $user->github_url) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://github.com/username">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">URL LinkedIn</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">URL Instagram</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://instagram.com/username">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Link WhatsApp Direct</label>
                        <input type="url" name="whatsapp_url" value="{{ old('whatsapp_url', $user->whatsapp_url) }}" class="w-full px-4 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="https://wa.me/6289639685566">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-xl font-bold text-sm text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20 flex items-center gap-2 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    <span>Simpan Perubahan Profil & Sosmed</span>
                </button>
            </div>

        </form>

        <!-- Card Ubah Kata Sandi (Password) Admin -->
        <form action="{{ route('password.update') }}" method="POST" class="mt-8 bg-[#242424] p-6 sm:p-8 rounded-2xl border border-[#353535] shadow-xl space-y-6">
            @csrf
            @method('PUT')

            <div>
                <h3 class="text-base font-bold text-[#A5B698] pb-2 border-b border-[#353535] mb-1 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#A5B698]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span>Ubah Kata Sandi (Password) Akun Admin</span>
                </h3>
                <p class="text-xs text-[#929292] mt-1">Gunakan kata sandi baru yang aman dan sulit ditebak untuk melindungi akses login ke panel CMS ini.</p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>Kata sandi admin berhasil diperbarui!</span>
                </div>
            @endif

            @if ($errors->updatePassword->any())
                <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-bold space-y-1">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Gagal Mengubah Kata Sandi:</span>
                    </div>
                    <ul class="list-disc list-inside pl-4 font-normal text-[11px]">
                        @foreach ($errors->updatePassword->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Current Password -->
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Kata Sandi Saat Ini</label>
                    <div class="relative">
                        <input type="password" id="input_current_password" name="current_password" required autocomplete="current-password" class="w-full pl-4 pr-10 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('input_current_password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#929292] hover:text-[#758268] transition" title="Lihat / Sembunyikan Sandi">
                            <svg class="eye-show w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="eye-hide w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" id="input_new_password" name="password" required autocomplete="new-password" minlength="8" oninput="checkPasswordMatch()" class="w-full pl-4 pr-10 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Minimal 8 karakter">
                        <button type="button" onclick="togglePasswordVisibility('input_new_password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#929292] hover:text-[#758268] transition" title="Lihat / Sembunyikan Sandi">
                            <svg class="eye-show w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="eye-hide w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-bold text-[#F0EEE8] mb-2">Konfirmasi Sandi Baru</label>
                    <div class="relative">
                        <input type="password" id="input_confirm_password" name="password_confirmation" required autocomplete="new-password" minlength="8" oninput="checkPasswordMatch()" class="w-full pl-4 pr-10 py-3 bg-[#191919] border border-[#353535] rounded-xl text-sm text-[#F0EEE8] placeholder-[#929292]/50 focus:outline-none focus:border-[#758268] focus:ring-1 focus:ring-[#758268]" placeholder="Ulangi sandi baru">
                        <button type="button" onclick="togglePasswordVisibility('input_confirm_password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#929292] hover:text-[#758268] transition" title="Lihat / Sembunyikan Sandi">
                            <svg class="eye-show w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="eye-hide w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                    <p id="pw-match-msg" class="text-[11px] mt-1.5 hidden"></p>
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" class="px-7 py-3 rounded-xl font-bold text-sm text-[#F0EEE8] bg-[#758268] hover:bg-[#859376] border border-[#8a997a]/30 transition shadow-md shadow-[#758268]/20 flex items-center gap-2 active:scale-95">
                    <svg class="w-4 h-4 text-[#F0EEE8]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>Perbarui Kata Sandi</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            const showSvg = btn.querySelector('.eye-show');
            const hideSvg = btn.querySelector('.eye-hide');
            if (showSvg && hideSvg) {
                showSvg.classList.toggle('hidden', isPassword);
                hideSvg.classList.toggle('hidden', !isPassword);
            }
        }

        function checkPasswordMatch() {
            const p1 = document.getElementById('input_new_password')?.value || '';
            const p2 = document.getElementById('input_confirm_password')?.value || '';
            const msg = document.getElementById('pw-match-msg');
            if (!msg) return;

            if (p2.length === 0) {
                msg.classList.add('hidden');
                return;
            }

            msg.classList.remove('hidden');
            if (p1 === p2) {
                msg.className = 'text-[11px] mt-1.5 text-emerald-400 font-semibold flex items-center gap-1';
                msg.innerHTML = '✓ Konfirmasi cocok dengan kata sandi baru';
            } else {
                msg.className = 'text-[11px] mt-1.5 text-rose-400 font-semibold flex items-center gap-1';
                msg.innerHTML = '✕ Belum cocok, pastikan sama persis';
            }
        }
    </script>

</x-cms-layout>
